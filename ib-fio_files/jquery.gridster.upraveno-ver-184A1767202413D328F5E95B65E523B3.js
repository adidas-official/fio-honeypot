
;(function(root, factory) {
if (typeof define === 'function' && define.amd) {
define('gridster-coords', ['jquery'], factory);
} else {
root.GridsterCoords = factory(root.$ || root.jQuery);
}
}(this, function($) {

function Coords(obj) {
if (obj[0] && $.isPlainObject(obj[0])) {
this.data = obj[0];
}else {
this.el = obj;
}
this.isCoords = true;
this.coords = {};
this.init();
return this;
}
var fn = Coords.prototype;
fn.init = function(){
this.set();
this.original_coords = this.get();
};
fn.set = function(update, not_update_offsets) {
var el = this.el;
if (el && !update) {
this.data = el.offset();
this.data.width = el.width();
this.data.height = el.height();
}
if (el && update && !not_update_offsets) {
var offset = el.offset();
this.data.top = offset.top;
this.data.left = offset.left;
}
var d = this.data;
typeof d.left === 'undefined' && (d.left = d.x1);
typeof d.top === 'undefined' && (d.top = d.y1);
this.coords.x1 = d.left;
this.coords.y1 = d.top;
this.coords.x2 = d.left + d.width;
this.coords.y2 = d.top + d.height;
this.coords.cx = d.left + (d.width / 2);
this.coords.cy = d.top + (d.height / 2);
this.coords.width = d.width;
this.coords.height = d.height;
this.coords.el = el || false ;
return this;
};
fn.update = function(data){
if (!data && !this.el) {
return this;
}
if (data) {
var new_data = $.extend({}, this.data, data);
this.data = new_data;
return this.set(true, true);
}
this.set(true);
return this;
};
fn.get = function(){
return this.coords;
};
fn.destroy = function() {
this.el.removeData('coords');
delete this.el;
};

 $.fn.coords = function() {
if (this.data('coords') ) {
return this.data('coords');
}
var ins = new Coords(this, arguments[0]);
this.data('coords', ins);
return ins;
};
return Coords;
}));
;(function(root, factory) {
if (typeof define === 'function' && define.amd) {
define('gridster-collision', ['jquery', 'gridster-coords'], factory);
} else {
root.GridsterCollision = factory(root.$ || root.jQuery,
root.GridsterCoords);
}
}(this, function($, Coords) {
var defaults = {
colliders_context: document.body,
overlapping_region: 'C'

 
 
 };

function Collision(el, colliders, options) {
this.options = $.extend(defaults, options);
this.$element = el;
this.last_colliders = [];
this.last_colliders_coords = [];
this.set_colliders(colliders);
this.init();
}
Collision.defaults = defaults;
var fn = Collision.prototype;
fn.init = function() {
this.find_collisions();
};
fn.overlaps = function(a, b) {
var x = false;
var y = false;
if ((b.x1 >= a.x1 && b.x1 <= a.x2) ||
(b.x2 >= a.x1 && b.x2 <= a.x2) ||
(a.x1 >= b.x1 && a.x2 <= b.x2)
) { x = true; }
if ((b.y1 >= a.y1 && b.y1 <= a.y2) ||
(b.y2 >= a.y1 && b.y2 <= a.y2) ||
(a.y1 >= b.y1 && a.y2 <= b.y2)
) { y = true; }
return (x && y);
};
fn.detect_overlapping_region = function(a, b){
var regionX = '';
var regionY = '';
if (a.y1 > b.cy && a.y1 < b.y2) { regionX = 'N'; }
if (a.y2 > b.y1 && a.y2 < b.cy) { regionX = 'S'; }
if (a.x1 > b.cx && a.x1 < b.x2) { regionY = 'W'; }
if (a.x2 > b.x1 && a.x2 < b.cx) { regionY = 'E'; }
return (regionX + regionY) || 'C';
};
fn.calculate_overlapped_area_coords = function(a, b){
var x1 = Math.max(a.x1, b.x1);
var y1 = Math.max(a.y1, b.y1);
var x2 = Math.min(a.x2, b.x2);
var y2 = Math.min(a.y2, b.y2);
return $({
left: x1,
top: y1,
width : (x2 - x1),
height: (y2 - y1)
}).coords().get();
};
fn.calculate_overlapped_area = function(coords){
return (coords.width * coords.height);
};
fn.manage_colliders_start_stop = function(new_colliders_coords, start_callback, stop_callback){
var last = this.last_colliders_coords;
for (var i = 0, il = last.length; i < il; i++) {
if ($.inArray(last[i], new_colliders_coords) === -1) {
start_callback.call(this, last[i]);
}
}
for (var j = 0, jl = new_colliders_coords.length; j < jl; j++) {
if ($.inArray(new_colliders_coords[j], last) === -1) {
stop_callback.call(this, new_colliders_coords[j]);
}
}
};
fn.find_collisions = function(player_data_coords){
var self = this;
var overlapping_region = this.options.overlapping_region;
var colliders_coords = [];
var colliders_data = [];
var $colliders = (this.colliders || this.$colliders);
var count = $colliders.length;
var player_coords = self.$element.coords()
.update(player_data_coords || false).get();
while(count--){
var $collider = self.$colliders ?
$($colliders[count]) : $colliders[count];
var $collider_coords_ins = ($collider.isCoords) ?
$collider : $collider.coords();
var collider_coords = $collider_coords_ins.get();
var overlaps = self.overlaps(player_coords, collider_coords);
if (!overlaps) {
continue;
}
var region = self.detect_overlapping_region(
player_coords, collider_coords);

 if (region === overlapping_region || overlapping_region === 'all') {
var area_coords = self.calculate_overlapped_area_coords(
player_coords, collider_coords);
var area = self.calculate_overlapped_area(area_coords);
var collider_data = {
area: area,
area_coords : area_coords,
region: region,
coords: collider_coords,
player_coords: player_coords,
el: $collider
};
if (self.options.on_overlap) {
self.options.on_overlap.call(this, collider_data);
}
colliders_coords.push($collider_coords_ins);
colliders_data.push(collider_data);
}
}
if (self.options.on_overlap_stop || self.options.on_overlap_start) {
this.manage_colliders_start_stop(colliders_coords,
self.options.on_overlap_start, self.options.on_overlap_stop);
}
this.last_colliders_coords = colliders_coords;
return colliders_data;
};
fn.get_closest_colliders = function(player_data_coords){
var colliders = this.find_collisions(player_data_coords);
colliders.sort(function(a, b) {

if (a.region === 'C' && b.region === 'C') {
if (a.coords.y1 < b.coords.y1 || a.coords.x1 < b.coords.x1) {
return - 1;
}else{
return 1;
}
}
if (a.area < b.area) {
return 1;
}
return 1;
});
return colliders;
};
fn.set_colliders = function(colliders) {
if (typeof colliders === 'string' || colliders instanceof $) {
this.$colliders = $(colliders,
this.options.colliders_context).not(this.$element);
}else{
this.colliders = $(colliders);
}
};

 $.fn.collision = function(collider, options) {
return new Collision( this, collider, options );
};
return Collision;
}));
;(function(window, undefined) {

window.delay = function(func, wait) {
var args = Array.prototype.slice.call(arguments, 2);
return setTimeout(function(){ return func.apply(null, args); }, wait);
};
window.debounce = function(func, wait, immediate) {
var timeout;
return function() {
var context = this, args = arguments;
var later = function() {
timeout = null;
if (!immediate) func.apply(context, args);
};
if (immediate && !timeout) func.apply(context, args);
clearTimeout(timeout);
timeout = setTimeout(later, wait);
};
};
window.throttle = function(func, wait) {
var context, args, timeout, throttling, more, result;
var whenDone = debounce(
function(){ more = throttling = false; }, wait);
return function() {
context = this; args = arguments;
var later = function() {
timeout = null;
if (more) func.apply(context, args);
whenDone();
};
if (!timeout) timeout = setTimeout(later, wait);
if (throttling) {
more = true;
} else {
result = func.apply(context, args);
}
whenDone();
throttling = true;
return result;
};
};
})(window);
;(function(root, factory) {
if (typeof define === 'function' && define.amd) {
define('gridster-draggable', ['jquery'], factory);
} else {
root.GridsterDraggable = factory(root.$ || root.jQuery);
}
}(this, function($) {
var defaults = {
items: 'li',
distance: 1,
limit: true,
offset_left: 0,
autoscroll: true,
ignore_dragging: ['INPUT', 'TEXTAREA', 'SELECT', 'BUTTON'], 
 handle: null,
container_width: 0, 
 move_element: true,
helper: false, 
 remove_helper: true

 
 
 };
var $window = $(window);
var dir_map = { x : 'left', y : 'top' };
var isTouch = !!('ontouchstart' in window);
var pointer_events = {
start: 'touchstart.gridster-draggable mousedown.gridster-draggable',
move: 'touchmove.gridster-draggable mousemove.gridster-draggable',
end: 'touchend.gridster-draggable mouseup.gridster-draggable'
};
var capitalize = function(str) {
return str.charAt(0).toUpperCase() + str.slice(1);
};

function Draggable(el, options) {
this.options = $.extend({}, defaults, options);
this.$document = $(document);
this.$container = $(el);
this.$dragitems = $(this.options.items, this.$container);
this.is_dragging = false;
this.player_min_left = 0 + this.options.offset_left;
this.init();
}
Draggable.defaults = defaults;
var fn = Draggable.prototype;
fn.init = function() {
var pos = this.$container.css('position');
this.calculate_dimensions();
this.$container.css('position', pos === 'static' ? 'relative' : pos);
this.disabled = false;
this.events();
$(window).bind('resize.gridster-draggable',
throttle($.proxy(this.calculate_dimensions, this), 200));
};
fn.events = function() {
this.$container.on('selectstart.gridster-draggable',
$.proxy(this.on_select_start, this));
this.$container.on(pointer_events.start, this.options.items,
$.proxy(this.drag_handler, this));
this.$document.on(pointer_events.end, $.proxy(function(e) {
this.is_dragging = false;
if (this.disabled) { return; }
this.$document.off(pointer_events.move);
if (this.drag_start) {
this.on_dragstop(e);
}
}, this));
};
fn.get_actual_pos = function($el) {
var pos = $el.position();
return pos;
};
fn.get_mouse_pos = function(e) {
if (e.originalEvent && e.originalEvent.touches) {
var oe = e.originalEvent;
e = oe.touches.length ? oe.touches[0] : oe.changedTouches[0];
}
return {
left: e.clientX,
top: e.clientY
};
};
fn.get_offset = function(e) {
e.preventDefault();
var mouse_actual_pos = this.get_mouse_pos(e);
var diff_x = Math.round(
mouse_actual_pos.left - this.mouse_init_pos.left);
var diff_y = Math.round(mouse_actual_pos.top - this.mouse_init_pos.top);
var left = Math.round(this.el_init_offset.left +
diff_x - this.baseX + $(window).scrollLeft() - this.win_offset_x);
var top = Math.round(this.el_init_offset.top +
diff_y - this.baseY + $(window).scrollTop() - this.win_offset_y);
if (this.options.limit) {
if (left > this.player_max_left) {
left = this.player_max_left;
} else if(left < this.player_min_left) {
left = this.player_min_left;
}
}
return {
position: {
left: left,
top: top
},
pointer: {
left: mouse_actual_pos.left,
top: mouse_actual_pos.top,
diff_left: diff_x + ($(window).scrollLeft() - this.win_offset_x),
diff_top: diff_y + ($(window).scrollTop() - this.win_offset_y)
}
};
};
fn.get_drag_data = function(e) {
var offset = this.get_offset(e);
offset.$player = this.$player;
offset.$helper = this.helper ? this.$helper : this.$player;
return offset;
};
fn.set_limits = function(container_width) {
container_width || (container_width = this.$container.width());
this.player_max_left = (container_width - this.player_width +
- this.options.offset_left);
this.options.container_width = container_width;
return this;
};
fn.scroll_in = function(axis, data) {
var dir_prop = dir_map[axis];
var area_size = 50;
var scroll_inc = 30;
var is_x = axis === 'x';
var window_size = is_x ? this.window_width : this.window_height;
var doc_size = is_x ? $(document).width() : $(document).height();
var player_size = is_x ? this.$player.width() : this.$player.height();
var next_scroll;
var scroll_offset = $window['scroll' + capitalize(dir_prop)]();
var min_window_pos = scroll_offset;
var max_window_pos = min_window_pos + window_size;
var mouse_next_zone = max_window_pos - area_size; 
 var mouse_prev_zone = min_window_pos + area_size; 

var abs_mouse_pos = min_window_pos + data.pointer[dir_prop];
var max_player_pos = (doc_size - window_size + player_size);
if (abs_mouse_pos >= mouse_next_zone) {
next_scroll = scroll_offset + scroll_inc;
if (next_scroll < max_player_pos) {
$window['scroll' + capitalize(dir_prop)](next_scroll);
this['scroll_offset_' + axis] += scroll_inc;
}
}
if (abs_mouse_pos <= mouse_prev_zone) {
next_scroll = scroll_offset - scroll_inc;
if (next_scroll > 0) {
$window['scroll' + capitalize(dir_prop)](next_scroll);
this['scroll_offset_' + axis] -= scroll_inc;
}
}
return this;
};
fn.manage_scroll = function(data) {
this.scroll_in('x', data);
this.scroll_in('y', data);
};
fn.calculate_dimensions = function(e) {
this.window_height = $window.height();
this.window_width = $window.width();
};
fn.drag_handler = function(e) {
var node = e.target.nodeName;

 if (this.disabled || e.which !== 1 && !isTouch) {
return;
}
if (this.ignore_drag(e)) {
return;
}
var self = this;
var first = true;
this.$player = $(e.currentTarget);
this.el_init_pos = this.get_actual_pos(this.$player);
this.mouse_init_pos = this.get_mouse_pos(e);
this.offsetY = this.mouse_init_pos.top - this.el_init_pos.top;
this.$document.on(pointer_events.move, function(mme) {
var mouse_actual_pos = self.get_mouse_pos(mme);
var diff_x = Math.abs(
mouse_actual_pos.left - self.mouse_init_pos.left);
var diff_y = Math.abs(
mouse_actual_pos.top - self.mouse_init_pos.top);
if (!(diff_x > self.options.distance ||
diff_y > self.options.distance)
) {
return false;
}
if (first) {
first = false;
self.on_dragstart.call(self, mme);
return false;
}
if (self.is_dragging === true) {
self.on_dragmove.call(self, mme);
}
return false;
});
if (!isTouch) { return false; }
};
fn.on_dragstart = function(e) {
e.preventDefault();
if (this.is_dragging) { return this; }
this.drag_start = this.is_dragging = true;
var offset = this.$container.offset();
this.baseX = Math.round(offset.left);
this.baseY = Math.round(offset.top);
var widthContainer = 0;
if(this.$container.width() >= this.options.container_width){
widthContainer = this.$container.width();
}
else{
widthContainer = this.options.container_width;
}
this.initial_container_width = widthContainer;




if (this.options.helper === 'clone') {
this.$helper = this.$player.clone()
.appendTo(this.$container).addClass('helper');
this.helper = true;
} else {
this.helper = false;
}
this.win_offset_y = $(window).scrollTop();
this.win_offset_x = $(window).scrollLeft();
this.scroll_offset_y = 0;
this.scroll_offset_x = 0;
this.el_init_offset = this.$player.offset();
this.player_width = this.$player.width();
this.player_height = this.$player.height();
this.set_limits(widthContainer);
if (this.options.start) {
this.options.start.call(this.$player, e, this.get_drag_data(e));
}
return false;
};
fn.on_dragmove = function(e) {
var data = this.get_drag_data(e);
this.options.autoscroll && this.manage_scroll(data);
if (this.options.move_element) {
(this.helper ? this.$helper : this.$player).css({
'position': 'absolute',
'left' : data.position.left,
'top' : data.position.top
});
}
var last_position = this.last_position || data.position;
data.prev_position = last_position;
if (this.options.drag) {
this.options.drag.call(this.$player, e, data);
}
this.last_position = data.position;
return false;
};
fn.on_dragstop = function(e) {
var data = this.get_drag_data(e);
this.drag_start = false;
if (this.options.stop) {
this.options.stop.call(this.$player, e, data);
}
if (this.helper && this.options.remove_helper) {
this.$helper.remove();
}
return false;
};
fn.on_select_start = function(e) {
if (this.disabled) { return; }
if (this.ignore_drag(e)) {
return;
}
return false;
};
fn.enable = function() {
this.disabled = false;
};
fn.disable = function() {
this.disabled = true;
};
fn.destroy = function() {
this.disable();
this.$container.off('.gridster-draggable');
this.$document.off('.gridster-draggable');
$(window).off('.gridster-draggable');
$.removeData(this.$container, 'drag');
};
fn.ignore_drag = function(event) {
if (this.options.handle) {
return !$(event.target).is(this.options.handle);
}
if ($.isFunction(this.options.ignore_dragging)) {
return this.options.ignore_dragging(event);
}

 
 if (this.options.resize) {
return ! $(event.target).is(this.options.items); 
 }
return $(event.target).is(this.options.ignore_dragging.join(', '));
};

 $.fn.drag = function ( options ) {
return new Draggable(this, options);
};
return Draggable;
}));
;(function(root, factory) {
if (typeof define === 'function' && define.amd) {
define(['jquery', 'gridster-draggable', 'gridster-collision'], factory);
} else {
root.Gridster = factory(root.$ || root.jQuery, root.GridsterDraggable,
root.GridsterCollision);
}
}(this, function($, Draggable, Collision) {
var defaults = {
namespace: '',
widget_selector: 'li',
widget_margins: [10, 10],
widget_base_dimensions: [400, 225],
extra_rows: 0,
extra_cols: 0,
min_cols: 1,
max_cols: Infinity,
min_rows: 15,
max_size_x: false,
autogrow_cols: false,
autogenerate_stylesheet: true,
avoid_overlapped_widgets: true,
auto_init: true,
serialize_params: function($w, wgd) {
return {
col: wgd.col,
row: wgd.row,
size_x: wgd.size_x,
size_y: wgd.size_y
};
},
collision: {},
draggable: {
items: '.gs-w',
distance: 4,
ignore_dragging: Draggable.defaults.ignore_dragging.slice(0)
},
resize: {
enabled: false,
axes: ['both'],
handle_append_to: '',
handle_class: 'gs-resize-handle',
max_size: [Infinity, Infinity],
min_size: [1, 1]
}
};

function Gridster(el, options) {
this.options = $.extend(true, {}, defaults, options);
this.$el = $(el);
this.$wrapper = this.$el.parent();
this.$widgets = this.$el.children(
this.options.widget_selector).addClass('gs-w');
this.widgets = [];
this.$changed = $([]);
this.wrapper_width = this.$wrapper.width();
this.min_widget_width = (this.options.widget_margins[0] * 2) +
this.options.widget_base_dimensions[0];
this.min_widget_height = (this.options.widget_margins[1] * 2) +
this.options.widget_base_dimensions[1];
this.generated_stylesheets = [];
this.$style_tags = $([]);
this.options.auto_init && this.init();
}
Gridster.defaults = defaults;
Gridster.generated_stylesheets = [];

Gridster.sort_by_row_asc = function(widgets) {
widgets = widgets.sort(function(a, b) {
if (!a.row) {
a = $(a).coords().grid;
b = $(b).coords().grid;
}
if (a.row > b.row) {
return 1;
}
return -1;
});
return widgets;
};

Gridster.sort_by_row_and_col_asc = function(widgets) {
widgets = widgets.sort(function(a, b) {
if (a.row > b.row || a.row === b.row && a.col > b.col) {
return 1;
}
return -1;
});
return widgets;
};

Gridster.sort_by_col_asc = function(widgets) {
widgets = widgets.sort(function(a, b) {
if (a.col > b.col) {
return 1;
}
return -1;
});
return widgets;
};

Gridster.sort_by_row_desc = function(widgets) {
widgets = widgets.sort(function(a, b) {
if (a.row + a.size_y < b.row + b.size_y) {
return 1;
}
return -1;
});
return widgets;
};

var fn = Gridster.prototype;
fn.init = function() {
this.options.resize.enabled && this.setup_resize();
this.generate_grid_and_stylesheet();
this.get_widgets_from_DOM();
this.set_dom_grid_height();
this.set_dom_grid_width();
this.$wrapper.addClass('ready');
this.draggable();
this.options.resize.enabled && this.resizable();
$(window).bind('resize.gridster', throttle(
$.proxy(this.recalculate_faux_grid, this), 200));
};

fn.disable = function() {
this.$wrapper.find('.player-revert').removeClass('player-revert');
this.drag_api.disable();
return this;
};

fn.enable = function() {
this.drag_api.enable();
return this;
};

fn.disable_resize = function() {
this.$el.addClass('gs-resize-disabled');
this.resize_api.disable();
return this;
};

fn.enable_resize = function() {
this.$el.removeClass('gs-resize-disabled');
this.resize_api.enable();
return this;
};

fn.add_widget = function(html, size_x, size_y, col, row, max_size, min_size) {
var pos;
size_x || (size_x = 1);
size_y || (size_y = 1);
if (!col & !row) {
pos = this.next_position(size_x, size_y);
} else {
pos = {
col: col,
row: row,
size_x: size_x,
size_y: size_y
};
this.empty_cells(col, row, size_x, size_y);
}
var $w = $(html).attr({
'data-col': pos.col,
'data-row': pos.row,
'data-sizex' : size_x,
'data-sizey' : size_y
}).addClass('gs-w').appendTo(this.$el).hide();
this.$widgets = this.$widgets.add($w);
this.register_widget($w);
this.add_faux_rows(pos.size_y);


if (max_size) {
this.set_widget_max_size($w, max_size);
}
if (min_size) {
this.set_widget_min_size($w, min_size);
}
this.set_dom_grid_width();
this.set_dom_grid_height();
this.drag_api.set_limits(this.cols * this.min_widget_width);
return $w.fadeIn();
};

fn.set_widget_min_size = function($widget, min_size) {
$widget = typeof $widget === 'number' ?
this.$widgets.eq($widget) : $widget;
if (!$widget.length) { return this; }
var wgd = $widget.data('coords').grid;
wgd.min_size_x = min_size[0];
wgd.min_size_y = min_size[1];
return this;
};

fn.set_widget_max_size = function($widget, max_size) {
$widget = typeof $widget === 'number' ?
this.$widgets.eq($widget) : $widget;
if (!$widget.length) { return this; }
var wgd = $widget.data('coords').grid;
wgd.max_size_x = max_size[0];
wgd.max_size_y = max_size[1];
return this;
};

fn.add_resize_handle = function($w) {
var append_to = this.options.resize.handle_append_to;
$(this.resize_handle_tpl).appendTo( append_to ? $(append_to, $w) : $w);
return this;
};

fn.resize_widget = function($widget, size_x, size_y, callback) {
var wgd = $widget.coords().grid;
var col = wgd.col;
var max_cols = this.options.max_cols;
var old_size_y = wgd.size_y;
var old_col = wgd.col;
var new_col = old_col;
size_x || (size_x = wgd.size_x);
size_y || (size_y = wgd.size_y);
if (max_cols !== Infinity) {
size_x = Math.min(size_x, max_cols - col + 1);
}
if (size_y > old_size_y) {
this.add_faux_rows(Math.max(size_y - old_size_y, 0));
}
var player_rcol = (col + size_x - 1);
if (player_rcol > this.cols) {
this.add_faux_cols(player_rcol - this.cols);
}
var new_grid_data = {
col: new_col,
row: wgd.row,
size_x: size_x,
size_y: size_y
};
this.mutate_widget_in_gridmap($widget, wgd, new_grid_data);
this.set_dom_grid_height();
this.set_dom_grid_width();
if (callback) {
callback.call(this, new_grid_data.size_x, new_grid_data.size_y);
}
return $widget;
};

fn.mutate_widget_in_gridmap = function($widget, wgd, new_wgd) {
var old_size_x = wgd.size_x;
var old_size_y = wgd.size_y;
var old_cells_occupied = this.get_cells_occupied(wgd);
var new_cells_occupied = this.get_cells_occupied(new_wgd);
var empty_cols = [];
$.each(old_cells_occupied.cols, function(i, col) {
if ($.inArray(col, new_cells_occupied.cols) === -1) {
empty_cols.push(col);
}
});
var occupied_cols = [];
$.each(new_cells_occupied.cols, function(i, col) {
if ($.inArray(col, old_cells_occupied.cols) === -1) {
occupied_cols.push(col);
}
});
var empty_rows = [];
$.each(old_cells_occupied.rows, function(i, row) {
if ($.inArray(row, new_cells_occupied.rows) === -1) {
empty_rows.push(row);
}
});
var occupied_rows = [];
$.each(new_cells_occupied.rows, function(i, row) {
if ($.inArray(row, old_cells_occupied.rows) === -1) {
occupied_rows.push(row);
}
});
this.remove_from_gridmap(wgd);
if (occupied_cols.length) {
var cols_to_empty = [
new_wgd.col, new_wgd.row, new_wgd.size_x, Math.min(old_size_y, new_wgd.size_y), $widget
];
this.empty_cells.apply(this, cols_to_empty);
}
if (occupied_rows.length) {
var rows_to_empty = [new_wgd.col, new_wgd.row, new_wgd.size_x, new_wgd.size_y, $widget];
this.empty_cells.apply(this, rows_to_empty);
}

 wgd.col = new_wgd.col;
wgd.row = new_wgd.row;
wgd.size_x = new_wgd.size_x;
wgd.size_y = new_wgd.size_y;
this.add_to_gridmap(new_wgd, $widget);
$widget.removeClass('player-revert');

 $widget.data('coords').update({
width: (new_wgd.size_x * this.options.widget_base_dimensions[0] +
((new_wgd.size_x - 1) * this.options.widget_margins[0]) * 2),
height: (new_wgd.size_y * this.options.widget_base_dimensions[1] +
((new_wgd.size_y - 1) * this.options.widget_margins[1]) * 2)
});
$widget.attr({
'data-col': new_wgd.col,
'data-row': new_wgd.row,
'data-sizex': new_wgd.size_x,
'data-sizey': new_wgd.size_y
});
if (empty_cols.length) {
var cols_to_remove_holes = [
empty_cols[0], new_wgd.row,
empty_cols.length,
Math.min(old_size_y, new_wgd.size_y),
$widget
];
this.remove_empty_cells.apply(this, cols_to_remove_holes);
}
if (empty_rows.length) {
var rows_to_remove_holes = [
new_wgd.col, new_wgd.row, new_wgd.size_x, new_wgd.size_y, $widget
];
this.remove_empty_cells.apply(this, rows_to_remove_holes);
}
this.move_widget_up($widget);
return this;
};

fn.empty_cells = function(col, row, size_x, size_y, $exclude) {
var $nexts = this.widgets_below({
col: col,
row: row - size_y,
size_x: size_x,
size_y: size_y
});
$nexts.not($exclude).each($.proxy(function(i, w) {
var wgd = $(w).coords().grid;
if ( !(wgd.row <= (row + size_y - 1))) { return; }
var diff = (row + size_y) - wgd.row;
this.move_widget_down($(w), diff);
}, this));
this.set_dom_grid_height();
return this;
};

fn.remove_empty_cells = function(col, row, size_x, size_y, exclude) {
var $nexts = this.widgets_below({
col: col,
row: row,
size_x: size_x,
size_y: size_y
});
$nexts.not(exclude).each($.proxy(function(i, widget) {
this.move_widget_up( $(widget), size_y );
}, this));
this.set_dom_grid_height();
return this;
};

fn.next_position = function(size_x, size_y) {
size_x || (size_x = 1);
size_y || (size_y = 1);
var ga = this.gridmap;
var cols_l = ga.length;
var valid_pos = [];
var rows_l;
for (var c = 1; c < cols_l; c++) {
rows_l = ga[c].length;
for (var r = 1; r <= rows_l; r++) {
var can_move_to = this.can_move_to({
size_x: size_x,
size_y: size_y
}, c, r);
if (can_move_to) {
valid_pos.push({
col: c,
row: r,
size_y: size_y,
size_x: size_x
});
}
}
}
if (valid_pos.length) {
return Gridster.sort_by_row_and_col_asc(valid_pos)[0];
}
return false;
};

fn.remove_widget = function(el, silent, callback) {
var $el = el instanceof $ ? el : $(el);
var wgd = $el.coords().grid;

 if ($.isFunction(silent)) {
callback = silent;
silent = false;
}
this.cells_occupied_by_placeholder = {};
this.$widgets = this.$widgets.not($el);
var $nexts = this.widgets_below($el);
this.remove_from_gridmap(wgd);
$el.fadeOut($.proxy(function() {
$el.remove();
if (!silent) {
$nexts.each($.proxy(function(i, widget) {
this.move_widget_up( $(widget), wgd.size_y );
}, this));
}
this.set_dom_grid_height();
if (callback) {
callback.call(this, el);
}
}, this));
return this;
};

fn.remove_all_widgets = function(callback) {
this.$widgets.each($.proxy(function(i, el){
this.remove_widget(el, true, callback);
}, this));
return this;
};

fn.serialize = function($widgets) {
$widgets || ($widgets = this.$widgets);
return $widgets.map($.proxy(function(i, widget) {
var $w = $(widget);
return this.options.serialize_params($w, $w.coords().grid);
}, this)).get();
};

fn.serialize_changed = function() {
return this.serialize(this.$changed);
};

fn.dom_to_coords = function($widget) {
return {
'col': parseInt($widget.attr('data-col'), 10),
'row': parseInt($widget.attr('data-row'), 10),
'size_x': parseInt($widget.attr('data-sizex'), 10) || 1,
'size_y': parseInt($widget.attr('data-sizey'), 10) || 1,
'max_size_x': parseInt($widget.attr('data-max-sizex'), 10) || false,
'max_size_y': parseInt($widget.attr('data-max-sizey'), 10) || false,
'min_size_x': parseInt($widget.attr('data-min-sizex'), 10) || false,
'min_size_y': parseInt($widget.attr('data-min-sizey'), 10) || false,
'el': $widget
};
};

fn.register_widget = function($el) {
var isDOM = $el instanceof jQuery;
var wgd = isDOM ? this.dom_to_coords($el) : $el;
var posChanged = false;
isDOM || ($el = wgd.el);
var empty_upper_row = this.can_go_widget_up(wgd);
if (empty_upper_row) {
wgd.row = empty_upper_row;
$el.attr('data-row', empty_upper_row);
this.$el.trigger('gridster:positionchanged', [wgd]);
posChanged = true;
}
if (this.options.avoid_overlapped_widgets &&
!this.can_move_to(
{size_x: wgd.size_x, size_y: wgd.size_y}, wgd.col, wgd.row)
) {
$.extend(wgd, this.next_position(wgd.size_x, wgd.size_y));
$el.attr({
'data-col': wgd.col,
'data-row': wgd.row,
'data-sizex': wgd.size_x,
'data-sizey': wgd.size_y
});
posChanged = true;
}

 $el.data('coords', $el.coords());

 $el.data('coords').grid = wgd;
this.add_to_gridmap(wgd, $el);
this.options.resize.enabled && this.add_resize_handle($el);
return posChanged;
};

fn.update_widget_position = function(grid_data, value) {
this.for_each_cell_occupied(grid_data, function(col, row) {
if (!this.gridmap[col]) { return this; }
this.gridmap[col][row] = value;
});
return this;
};

fn.remove_from_gridmap = function(grid_data) {
return this.update_widget_position(grid_data, false);
};

fn.add_to_gridmap = function(grid_data, value) {
this.update_widget_position(grid_data, value || grid_data.el);
if (grid_data.el) {
var $widgets = this.widgets_below(grid_data.el);
$widgets.each($.proxy(function(i, widget) {
this.move_widget_up( $(widget));
}, this));
}
};

fn.draggable = function() {
var self = this;
var draggable_options = $.extend(true, {}, this.options.draggable, {
offset_left: this.options.widget_margins[0],
offset_top: this.options.widget_margins[1],
container_width: this.cols * this.min_widget_width,
limit: true,
start: function(event, ui) {
self.$widgets.filter('.player-revert')
.removeClass('player-revert');
self.$player = $(this);
self.$helper = $(ui.$helper);
self.helper = !self.$helper.is(self.$player);
self.on_start_drag.call(self, event, ui);
self.$el.trigger('gridster:dragstart');
},
stop: function(event, ui) {
self.on_stop_drag.call(self, event, ui);
self.$el.trigger('gridster:dragstop');
},
drag: throttle(function(event, ui) {
self.on_drag.call(self, event, ui);
self.$el.trigger('gridster:drag');
}, 60)
});
this.drag_api = this.$el.drag(draggable_options);
return this;
};

fn.resizable = function() {
this.resize_api = this.$el.drag({
items: '.' + this.options.resize.handle_class,
offset_left: this.options.widget_margins[0],
container_width: this.container_width,
move_element: false,
resize: true,
limit: this.options.autogrow_cols ? false : true,
start: $.proxy(this.on_start_resize, this),
stop: $.proxy(function(event, ui) {
delay($.proxy(function() {
this.on_stop_resize(event, ui);
}, this), 120);
}, this),
drag: throttle($.proxy(this.on_resize, this), 60)
});
return this;
};

fn.setup_resize = function() {
this.resize_handle_class = this.options.resize.handle_class;
var axes = this.options.resize.axes;
var handle_tpl = '<span class="' + this.resize_handle_class + ' ' +
this.resize_handle_class + '-{type}" ></span>';
this.resize_handle_tpl = $.map(axes, function(type) {
return handle_tpl.replace('{type}', type);
}).join('');
if ($.isArray(this.options.draggable.ignore_dragging)) {
this.options.draggable.ignore_dragging.push(
'.' + this.resize_handle_class);
}
return this;
};

fn.on_start_drag = function(event, ui) {
this.$helper.add(this.$player).add(this.$wrapper).addClass('dragging');
this.highest_col = this.get_highest_occupied_cell().col;
this.$player.addClass('player');
this.player_grid_data = this.$player.coords().grid;
this.placeholder_grid_data = $.extend({}, this.player_grid_data);
this.set_dom_grid_height(this.$el.height() +
(this.player_grid_data.size_y * this.min_widget_height));
this.set_dom_grid_width(this.cols);
var pgd_sizex = this.player_grid_data.size_x;
var cols_diff = this.cols - this.highest_col;
if (this.options.autogrow_cols && cols_diff <= pgd_sizex) {
this.add_faux_cols(Math.min(pgd_sizex - cols_diff, 1));
}
var colliders = this.faux_grid;
var coords = this.$player.data('coords').coords;
this.cells_occupied_by_player = this.get_cells_occupied(
this.player_grid_data);
this.cells_occupied_by_placeholder = this.get_cells_occupied(
this.placeholder_grid_data);
this.last_cols = [];
this.last_rows = [];

 this.collision_api = this.$helper.collision(
colliders, this.options.collision);
this.$preview_holder = $('<' + this.$player.get(0).tagName + ' />', {
'class': 'preview-holder',
'data-row': this.$player.attr('data-row'),
'data-col': this.$player.attr('data-col'),
css: {
width: coords.width,
height: coords.height
}
}).appendTo(this.$el);
if (this.options.draggable.start) {
this.options.draggable.start.call(this, event, ui);
}
};

fn.on_drag = function(event, ui) {

 if (this.$player === null) {
return false;
}
var abs_offset = {
left: ui.position.left + this.baseX,
top: ui.position.top + this.baseY
};

 if (this.options.autogrow_cols) {
var prcol = this.placeholder_grid_data.col +
this.placeholder_grid_data.size_x - 1;

 if (prcol >= this.cols - 1 && this.options.max_cols >= this.cols + 1) {
this.add_faux_cols(1);
this.set_dom_grid_width(this.cols + 1);
this.drag_api.set_limits(this.container_width);
}
this.collision_api.set_colliders(this.faux_grid);
}
this.colliders_data = this.collision_api.get_closest_colliders(
abs_offset);
this.on_overlapped_column_change(
this.on_start_overlapping_column, this.on_stop_overlapping_column);
this.on_overlapped_row_change(
this.on_start_overlapping_row, this.on_stop_overlapping_row);
if (this.helper && this.$player) {
this.$player.css({
'left': ui.position.left,
'top': ui.position.top
});
}
if (this.options.draggable.drag) {
this.options.draggable.drag.call(this, event, ui);
}
};

fn.on_stop_drag = function(event, ui) {
this.$helper.add(this.$player).add(this.$wrapper)
.removeClass('dragging');
ui.position.left = ui.position.left + this.baseX;
ui.position.top = ui.position.top + this.baseY;
this.colliders_data = this.collision_api.get_closest_colliders(
ui.position);
this.on_overlapped_column_change(
this.on_start_overlapping_column,
this.on_stop_overlapping_column
);
this.on_overlapped_row_change(
this.on_start_overlapping_row,
this.on_stop_overlapping_row
);
this.$player.addClass('player-revert').removeClass('player')
.attr({
'data-col': this.placeholder_grid_data.col,
'data-row': this.placeholder_grid_data.row
}).css({
'left': '',
'top': ''
});
this.$changed = this.$changed.add(this.$player);
this.cells_occupied_by_player = this.get_cells_occupied(
this.placeholder_grid_data);
this.set_cells_player_occupies(
this.placeholder_grid_data.col, this.placeholder_grid_data.row);
this.$player.coords().grid.row = this.placeholder_grid_data.row;
this.$player.coords().grid.col = this.placeholder_grid_data.col;
if (this.options.draggable.stop) {
this.options.draggable.stop.call(this, event, ui);
}
this.$preview_holder.remove();
this.$player = null;
this.$helper = null;
this.placeholder_grid_data = {};
this.player_grid_data = {};
this.cells_occupied_by_placeholder = {};
this.cells_occupied_by_player = {};
this.set_dom_grid_height();
this.set_dom_grid_width();
if (this.options.autogrow_cols) {
this.drag_api.set_limits(this.cols * this.min_widget_width);
}
};

fn.on_start_resize = function(event, ui) {
this.$resized_widget = ui.$player.closest('.gs-w');
this.resize_coords = this.$resized_widget.coords();
this.resize_wgd = this.resize_coords.grid;
this.resize_initial_width = this.resize_coords.coords.width;
this.resize_initial_height = this.resize_coords.coords.height;
this.resize_initial_sizex = this.resize_coords.grid.size_x;
this.resize_initial_sizey = this.resize_coords.grid.size_y;
this.resize_initial_col = this.resize_coords.grid.col;
this.resize_last_sizex = this.resize_initial_sizex;
this.resize_last_sizey = this.resize_initial_sizey;
this.resize_max_size_x = Math.min(this.resize_wgd.max_size_x ||
this.options.resize.max_size[0],
this.options.max_cols - this.resize_initial_col + 1);
this.resize_max_size_y = this.resize_wgd.max_size_y ||
this.options.resize.max_size[1];
this.resize_min_size_x = (this.resize_wgd.min_size_x ||
this.options.resize.min_size[0] || 1);
this.resize_min_size_y = (this.resize_wgd.min_size_y ||
this.options.resize.min_size[1] || 1);
this.resize_initial_last_col = this.get_highest_occupied_cell().col;
this.set_dom_grid_width(this.cols);
this.resize_dir = {
right: ui.$player.is('.' + this.resize_handle_class + '-x'),
bottom: ui.$player.is('.' + this.resize_handle_class + '-y')
};
this.$resized_widget.css({
'min-width': this.options.widget_base_dimensions[0],
'min-height': this.options.widget_base_dimensions[1]
});
var nodeName = this.$resized_widget.get(0).tagName;
this.$resize_preview_holder = $('<' + nodeName + ' />', {
'class': 'preview-holder resize-preview-holder',
'data-row': this.$resized_widget.attr('data-row'),
'data-col': this.$resized_widget.attr('data-col'),
'css': {
'width': this.resize_initial_width,
'height': this.resize_initial_height
}
}).appendTo(this.$el);
this.$resized_widget.addClass('resizing');
if (this.options.resize.start) {
this.options.resize.start.call(this, event, ui, this.$resized_widget);
}
this.$el.trigger('gridster:resizestart');
};

fn.on_stop_resize = function(event, ui) {
this.$resized_widget
.removeClass('resizing')
.css({
'width': '',
'height': ''
});
delay($.proxy(function() {
this.$resize_preview_holder
.remove()
.css({
'min-width': '',
'min-height': ''
});
if (this.options.resize.stop) {
this.options.resize.stop.call(this, event, ui, this.$resized_widget);
}
this.$el.trigger('gridster:resizestop');
}, this), 300);
this.set_dom_grid_width();
if (this.options.autogrow_cols) {
this.drag_api.set_limits(this.cols * this.min_widget_width);
}
};

fn.on_resize = function(event, ui) {
var rel_x = (ui.pointer.diff_left);
var rel_y = (ui.pointer.diff_top);
var wbd_x = this.options.widget_base_dimensions[0];
var wbd_y = this.options.widget_base_dimensions[1];
var margin_x = this.options.widget_margins[0];
var margin_y = this.options.widget_margins[1];
var max_size_x = this.resize_max_size_x;
var min_size_x = this.resize_min_size_x;
var max_size_y = this.resize_max_size_y;
var min_size_y = this.resize_min_size_y;
var autogrow = this.options.autogrow_cols;
var width;
var max_width = Infinity;
var max_height = Infinity;
var inc_units_x = Math.ceil((rel_x / (wbd_x + margin_x * 2)) - 0.2);
var inc_units_y = Math.ceil((rel_y / (wbd_y + margin_y * 2)) - 0.2);
var size_x = Math.max(1, this.resize_initial_sizex + inc_units_x);
var size_y = Math.max(1, this.resize_initial_sizey + inc_units_y);
var max_cols = (this.container_width / this.min_widget_width) -
this.resize_initial_col + 1;
var limit_width = ((max_cols * this.min_widget_width) - margin_x * 2);
size_x = Math.max(Math.min(size_x, max_size_x), min_size_x);
size_x = Math.min(max_cols, size_x);
width = (max_size_x * wbd_x) + ((size_x - 1) * margin_x * 2);
max_width = Math.min(width, limit_width);
min_width = (min_size_x * wbd_x) + ((size_x - 1) * margin_x * 2);
size_y = Math.max(Math.min(size_y, max_size_y), min_size_y);
max_height = (max_size_y * wbd_y) + ((size_y - 1) * margin_y * 2);
min_height = (min_size_y * wbd_y) + ((size_y - 1) * margin_y * 2);
if (this.resize_dir.right) {
size_y = this.resize_initial_sizey;
} else if (this.resize_dir.bottom) {
size_x = this.resize_initial_sizex;
}
if (autogrow) {
var last_widget_col = this.resize_initial_col + size_x - 1;
if (autogrow && this.resize_initial_last_col <= last_widget_col) {
this.set_dom_grid_width(Math.max(last_widget_col + 1, this.cols));
if (this.cols < last_widget_col) {
this.add_faux_cols(last_widget_col - this.cols);
}
}
}
var css_props = {};
!this.resize_dir.bottom && (css_props.width = Math.max(Math.min(
this.resize_initial_width + rel_x, max_width), min_width));
!this.resize_dir.right && (css_props.height = Math.max(Math.min(
this.resize_initial_height + rel_y, max_height), min_height));
this.$resized_widget.css(css_props);
if (size_x !== this.resize_last_sizex ||
size_y !== this.resize_last_sizey) {
this.resize_widget(this.$resized_widget, size_x, size_y);
this.set_dom_grid_width(this.cols);
this.$resize_preview_holder.css({
'width': '',
'height': ''
}).attr({
'data-row': this.$resized_widget.attr('data-row'),
'data-sizex': size_x,
'data-sizey': size_y
});
}
if (this.options.resize.resize) {
this.options.resize.resize.call(this, event, ui, this.$resized_widget);
}
this.$el.trigger('gridster:resize');
this.resize_last_sizex = size_x;
this.resize_last_sizey = size_y;
};

fn.on_overlapped_column_change = function(start_callback, stop_callback) {
if (!this.colliders_data.length) {
return this;
}
var cols = this.get_targeted_columns(
this.colliders_data[0].el.data.col);
var last_n_cols = this.last_cols.length;
var n_cols = cols.length;
var i;
for (i = 0; i < n_cols; i++) {
if ($.inArray(cols[i], this.last_cols) === -1) {
(start_callback || $.noop).call(this, cols[i]);
}
}
for (i = 0; i< last_n_cols; i++) {
if ($.inArray(this.last_cols[i], cols) === -1) {
(stop_callback || $.noop).call(this, this.last_cols[i]);
}
}
this.last_cols = cols;
return this;
};

fn.on_overlapped_row_change = function(start_callback, end_callback) {
if (!this.colliders_data.length) {
return this;
}
var rows = this.get_targeted_rows(this.colliders_data[0].el.data.row);
var last_n_rows = this.last_rows.length;
var n_rows = rows.length;
var i;
for (i = 0; i < n_rows; i++) {
if ($.inArray(rows[i], this.last_rows) === -1) {
(start_callback || $.noop).call(this, rows[i]);
}
}
for (i = 0; i < last_n_rows; i++) {
if ($.inArray(this.last_rows[i], rows) === -1) {
(end_callback || $.noop).call(this, this.last_rows[i]);
}
}
this.last_rows = rows;
};

fn.set_player = function(col, row, no_player) {
var self = this;
if (!no_player) {
this.empty_cells_player_occupies();
}
var cell = !no_player ? self.colliders_data[0].el.data : {col: col};
var to_col = cell.col;
var to_row = row || cell.row;
this.player_grid_data = {
col: to_col,
row: to_row,
size_y : this.player_grid_data.size_y,
size_x : this.player_grid_data.size_x
};
this.cells_occupied_by_player = this.get_cells_occupied(
this.player_grid_data);
var $overlapped_widgets = this.get_widgets_overlapped(
this.player_grid_data);
var constraints = this.widgets_constraints($overlapped_widgets);
this.manage_movements(constraints.can_go_up, to_col, to_row);
this.manage_movements(constraints.can_not_go_up, to_col, to_row);

if (!$overlapped_widgets.length) {
var pp = this.can_go_player_up(this.player_grid_data);
if (pp !== false) {
to_row = pp;
}
this.set_placeholder(to_col, to_row);
}
return {
col: to_col,
row: to_row
};
};

fn.widgets_constraints = function($widgets) {
var $widgets_can_go_up = $([]);
var $widgets_can_not_go_up;
var wgd_can_go_up = [];
var wgd_can_not_go_up = [];
$widgets.each($.proxy(function(i, w) {
var $w = $(w);
var wgd = $w.coords().grid;
if (this.can_go_widget_up(wgd)) {
$widgets_can_go_up = $widgets_can_go_up.add($w);
wgd_can_go_up.push(wgd);
} else {
wgd_can_not_go_up.push(wgd);
}
}, this));
$widgets_can_not_go_up = $widgets.not($widgets_can_go_up);
return {
can_go_up: Gridster.sort_by_row_asc(wgd_can_go_up),
can_not_go_up: Gridster.sort_by_row_desc(wgd_can_not_go_up)
};
};

fn.manage_movements = function($widgets, to_col, to_row) {
$.each($widgets, $.proxy(function(i, w) {
var wgd = w;
var $w = wgd.el;
var can_go_widget_up = this.can_go_widget_up(wgd);
if (can_go_widget_up) {

 
 this.move_widget_to($w, can_go_widget_up);
this.set_placeholder(to_col, can_go_widget_up + wgd.size_y);
} else {

 var can_go_player_up = this.can_go_player_up(
this.player_grid_data);
if (!can_go_player_up) {

 
 
 
 var y = (to_row + this.player_grid_data.size_y) - wgd.row;
this.move_widget_down($w, y);
this.set_placeholder(to_col, to_row);
}
}
}, this));
return this;
};

fn.is_player = function(col_or_el, row) {
if (row && !this.gridmap[col_or_el]) { return false; }
var $w = row ? this.gridmap[col_or_el][row] : col_or_el;
return $w && ($w.is(this.$player) || $w.is(this.$helper));
};

fn.is_player_in = function(col, row) {
var c = this.cells_occupied_by_player || {};
return $.inArray(col, c.cols) >= 0 && $.inArray(row, c.rows) >= 0;
};

fn.is_placeholder_in = function(col, row) {
var c = this.cells_occupied_by_placeholder || {};
return this.is_placeholder_in_col(col) && $.inArray(row, c.rows) >= 0;
};

fn.is_placeholder_in_col = function(col) {
var c = this.cells_occupied_by_placeholder || [];
return $.inArray(col, c.cols) >= 0;
};

fn.is_empty = function(col, row) {
if (typeof this.gridmap[col] !== 'undefined') {
if(typeof this.gridmap[col][row] !== 'undefined' &&
this.gridmap[col][row] === false
) {
return true;
}
return false;
}
return true;
};

fn.is_occupied = function(col, row) {
if (!this.gridmap[col]) {
return false;
}
if (this.gridmap[col][row]) {
return true;
}
return false;
};

fn.is_widget = function(col, row) {
var cell = this.gridmap[col];
if (!cell) {
return false;
}
cell = cell[row];
if (cell) {
return cell;
}
return false;
};

fn.is_widget_under_player = function(col, row) {
if (this.is_widget(col, row)) {
return this.is_player_in(col, row);
}
return false;
};

fn.get_widgets_under_player = function(cells) {
cells || (cells = this.cells_occupied_by_player || {cols: [], rows: []});
var $widgets = $([]);
$.each(cells.cols, $.proxy(function(i, col) {
$.each(cells.rows, $.proxy(function(i, row) {
if(this.is_widget(col, row)) {
$widgets = $widgets.add(this.gridmap[col][row]);
}
}, this));
}, this));
return $widgets;
};

fn.set_placeholder = function(col, row) {
var phgd = $.extend({}, this.placeholder_grid_data);
var $nexts = this.widgets_below({
col: phgd.col,
row: phgd.row,
size_y: phgd.size_y,
size_x: phgd.size_x
});

 var right_col = (col + phgd.size_x - 1);
if (right_col > this.cols) {
col = col - (right_col - col);
}
var moved_down = this.placeholder_grid_data.row < row;
var changed_column = this.placeholder_grid_data.col !== col;
this.placeholder_grid_data.col = col;
this.placeholder_grid_data.row = row;
this.cells_occupied_by_placeholder = this.get_cells_occupied(
this.placeholder_grid_data);
this.$preview_holder.attr({
'data-row' : row,
'data-col' : col
});
if (moved_down || changed_column) {
$nexts.each($.proxy(function(i, widget) {
this.move_widget_up(
$(widget), this.placeholder_grid_data.col - col + phgd.size_y);
}, this));
}
var $widgets_under_ph = this.get_widgets_under_player(
this.cells_occupied_by_placeholder);
if ($widgets_under_ph.length) {
$widgets_under_ph.each($.proxy(function(i, widget) {
var $w = $(widget);
this.move_widget_down(
$w, row + phgd.size_y - $w.data('coords').grid.row);
}, this));
}
};

fn.can_go_player_up = function(widget_grid_data) {
var p_bottom_row = widget_grid_data.row + widget_grid_data.size_y - 1;
var result = true;
var upper_rows = [];
var min_row = 10000;
var $widgets_under_player = this.get_widgets_under_player();

this.for_each_column_occupied(widget_grid_data, function(tcol) {
var grid_col = this.gridmap[tcol];
var r = p_bottom_row + 1;
upper_rows[tcol] = [];
while (--r > 0) {
if (this.is_empty(tcol, r) || this.is_player(tcol, r) ||
this.is_widget(tcol, r) &&
grid_col[r].is($widgets_under_player)
) {
upper_rows[tcol].push(r);
min_row = r < min_row ? r : min_row;
} else {
break;
}
}
if (upper_rows[tcol].length === 0) {
result = false;
return true; 
 }
upper_rows[tcol].sort(function(a, b) {
return a - b;
});
});
if (!result) { return false; }
return this.get_valid_rows(widget_grid_data, upper_rows, min_row);
};

fn.can_go_widget_up = function(widget_grid_data) {
var p_bottom_row = widget_grid_data.row + widget_grid_data.size_y - 1;
var result = true;
var upper_rows = [];
var min_row = 10000;

this.for_each_column_occupied(widget_grid_data, function(tcol) {
var grid_col = this.gridmap[tcol];
upper_rows[tcol] = [];
var r = p_bottom_row + 1;

 while (--r > 0) {
if (this.is_widget(tcol, r) && !this.is_player_in(tcol, r)) {
if (!grid_col[r].is(widget_grid_data.el)) {
break;
}
}
if (!this.is_player(tcol, r) &&
!this.is_placeholder_in(tcol, r) &&
!this.is_player_in(tcol, r)) {
upper_rows[tcol].push(r);
}
if (r < min_row) {
min_row = r;
}
}
if (upper_rows[tcol].length === 0) {
result = false;
return true; 
 }
upper_rows[tcol].sort(function(a, b) {
return a - b;
});
});
if (!result) { return false; }
return this.get_valid_rows(widget_grid_data, upper_rows, min_row);
};

fn.get_valid_rows = function(widget_grid_data, upper_rows, min_row) {
var p_top_row = widget_grid_data.row;
var p_bottom_row = widget_grid_data.row + widget_grid_data.size_y - 1;
var size_y = widget_grid_data.size_y;
var r = min_row - 1;
var valid_rows = [];
while (++r <= p_bottom_row ) {
var common = true;
$.each(upper_rows, function(col, rows) {
if ($.isArray(rows) && $.inArray(r, rows) === -1) {
common = false;
}
});
if (common === true) {
valid_rows.push(r);
if (valid_rows.length === size_y) {
break;
}
}
}
var new_row = false;
if (size_y === 1) {
if (valid_rows[0] !== p_top_row) {
new_row = valid_rows[0] || false;
}
} else {
if (valid_rows[0] !== p_top_row) {
new_row = this.get_consecutive_numbers_index(
valid_rows, size_y);
}
}
return new_row;
};
fn.get_consecutive_numbers_index = function(arr, size_y) {
var max = arr.length;
var result = [];
var first = true;
var prev = -1; 

for (var i=0; i < max; i++) {
if (first || arr[i] === prev + 1) {
result.push(i);
if (result.length === size_y) {
break;
}
first = false;
} else {
result = [];
first = true;
}
prev = arr[i];
}
return result.length >= size_y ? arr[result[0]] : false;
};

fn.get_widgets_overlapped = function() {
var $w;
var $widgets = $([]);
var used = [];
var rows_from_bottom = this.cells_occupied_by_player.rows.slice(0);
rows_from_bottom.reverse();
$.each(this.cells_occupied_by_player.cols, $.proxy(function(i, col) {
$.each(rows_from_bottom, $.proxy(function(i, row) {

 if (!this.gridmap[col]) { return true; } 
 var $w = this.gridmap[col][row];
if (this.is_occupied(col, row) && !this.is_player($w) &&
$.inArray($w, used) === -1
) {
$widgets = $widgets.add($w);
used.push($w);
}
}, this));
}, this));
return $widgets;
};

fn.on_start_overlapping_column = function(col) {
this.set_player(col, false);
};

fn.on_start_overlapping_row = function(row) {
this.set_player(false, row);
};

fn.on_stop_overlapping_column = function(col) {
this.set_player(col, false);
var self = this;
this.for_each_widget_below(col, this.cells_occupied_by_player.rows[0],
function(tcol, trow) {
self.move_widget_up(this, self.player_grid_data.size_y);
});
};

fn.on_stop_overlapping_row = function(row) {
this.set_player(false, row);
var self = this;
var cols = this.cells_occupied_by_player.cols;
for (var c = 0, cl = cols.length; c < cl; c++) {
this.for_each_widget_below(cols[c], row, function(tcol, trow) {
self.move_widget_up(this, self.player_grid_data.size_y);
});
}
};

fn.move_widget_to = function($widget, row) {
var self = this;
var widget_grid_data = $widget.coords().grid;
var diff = row - widget_grid_data.row;
var $next_widgets = this.widgets_below($widget);
var can_move_to_new_cell = this.can_move_to(
widget_grid_data, widget_grid_data.col, row, $widget);
if (can_move_to_new_cell === false) {
return false;
}
this.remove_from_gridmap(widget_grid_data);
widget_grid_data.row = row;
this.add_to_gridmap(widget_grid_data);
$widget.attr('data-row', row);
this.$changed = this.$changed.add($widget);
$next_widgets.each(function(i, widget) {
var $w = $(widget);
var wgd = $w.coords().grid;
var can_go_up = self.can_go_widget_up(wgd);
if (can_go_up && can_go_up !== wgd.row) {
self.move_widget_to($w, can_go_up);
}
});
return this;
};

fn.move_widget_up = function($widget, y_units) {
var el_grid_data = $widget.coords().grid;
var actual_row = el_grid_data.row;
var moved = [];
var can_go_up = true;
y_units || (y_units = 1);
if (!this.can_go_up($widget)) { return false; } 

this.for_each_column_occupied(el_grid_data, function(col) {

 if ($.inArray($widget, moved) === -1) {
var widget_grid_data = $widget.coords().grid;
var next_row = actual_row - y_units;
next_row = this.can_go_up_to_row(
widget_grid_data, col, next_row);
if (!next_row) {
return true;
}
var $next_widgets = this.widgets_below($widget);
this.remove_from_gridmap(widget_grid_data);
widget_grid_data.row = next_row;
this.add_to_gridmap(widget_grid_data);
$widget.attr('data-row', widget_grid_data.row);
this.$changed = this.$changed.add($widget);
moved.push($widget);
$next_widgets.each($.proxy(function(i, widget) {
this.move_widget_up($(widget), y_units);
}, this));
}
});
};

fn.move_widget_down = function($widget, y_units) {
var el_grid_data, actual_row, moved, y_diff;
if (y_units <= 0) { return false; }
el_grid_data = $widget.coords().grid;
actual_row = el_grid_data.row;
moved = [];
y_diff = y_units;
if (!$widget) { return false; }
if ($.inArray($widget, moved) === -1) {
var widget_grid_data = $widget.coords().grid;
var next_row = actual_row + y_units;
var $next_widgets = this.widgets_below($widget);
this.remove_from_gridmap(widget_grid_data);
$next_widgets.each($.proxy(function(i, widget) {
var $w = $(widget);
var wd = $w.coords().grid;
var tmp_y = this.displacement_diff(
wd, widget_grid_data, y_diff);
if (tmp_y > 0) {
this.move_widget_down($w, tmp_y);
}
}, this));
widget_grid_data.row = next_row;
this.update_widget_position(widget_grid_data, $widget);
$widget.attr('data-row', widget_grid_data.row);
this.$changed = this.$changed.add($widget);
moved.push($widget);
}
};

fn.can_go_up_to_row = function(widget_grid_data, col, row) {
var ga = this.gridmap;
var result = true;
var urc = []; 
 var actual_row = widget_grid_data.row;
var r;

this.for_each_column_occupied(widget_grid_data, function(tcol) {
var grid_col = ga[tcol];
urc[tcol] = [];
r = actual_row;
while (r--) {
if (this.is_empty(tcol, r) &&
!this.is_placeholder_in(tcol, r)
) {
urc[tcol].push(r);
} else {
break;
}
}
if (!urc[tcol].length) {
result = false;
return true;
}
});
if (!result) { return false; }

r = row;
for (r = 1; r < actual_row; r++) {
var common = true;
for (var uc = 0, ucl = urc.length; uc < ucl; uc++) {
if (urc[uc] && $.inArray(r, urc[uc]) === -1) {
common = false;
}
}
if (common === true) {
result = r;
break;
}
}
return result;
};
fn.displacement_diff = function(widget_grid_data, parent_bgd, y_units) {
var actual_row = widget_grid_data.row;
var diffs = [];
var parent_max_y = parent_bgd.row + parent_bgd.size_y;
this.for_each_column_occupied(widget_grid_data, function(col) {
var temp_y_units = 0;
for (var r = parent_max_y; r < actual_row; r++) {
if (this.is_empty(col, r)) {
temp_y_units = temp_y_units + 1;
}
}
diffs.push(temp_y_units);
});
var max_diff = Math.max.apply(Math, diffs);
y_units = (y_units - max_diff);
return y_units > 0 ? y_units : 0;
};

fn.widgets_below = function($el) {
var el_grid_data = $.isPlainObject($el) ? $el : $el.coords().grid;
var self = this;
var ga = this.gridmap;
var next_row = el_grid_data.row + el_grid_data.size_y - 1;
var $nexts = $([]);
this.for_each_column_occupied(el_grid_data, function(col) {
self.for_each_widget_below(col, next_row, function(tcol, trow) {
if (!self.is_player(this) && $.inArray(this, $nexts) === -1) {
$nexts = $nexts.add(this);
return true; 
 }
});
});
return Gridster.sort_by_row_asc($nexts);
};

fn.set_cells_player_occupies = function(col, row) {
this.remove_from_gridmap(this.placeholder_grid_data);
this.placeholder_grid_data.col = col;
this.placeholder_grid_data.row = row;
this.add_to_gridmap(this.placeholder_grid_data, this.$player);
return this;
};

fn.empty_cells_player_occupies = function() {
this.remove_from_gridmap(this.placeholder_grid_data);
return this;
};
fn.can_go_up = function($el) {
var el_grid_data = $el.coords().grid;
var initial_row = el_grid_data.row;
var prev_row = initial_row - 1;
var ga = this.gridmap;
var upper_rows_by_column = [];
var result = true;
if (initial_row === 1) { return false; }
this.for_each_column_occupied(el_grid_data, function(col) {
var $w = this.is_widget(col, prev_row);
if (this.is_occupied(col, prev_row) ||
this.is_player(col, prev_row) ||
this.is_placeholder_in(col, prev_row) ||
this.is_player_in(col, prev_row)
) {
result = false;
return true; 
 }
});
return result;
};

fn.can_move_to = function(widget_grid_data, col, row, max_row) {
var ga = this.gridmap;
var $w = widget_grid_data.el;
var future_wd = {
size_y: widget_grid_data.size_y,
size_x: widget_grid_data.size_x,
col: col,
row: row
};
var result = true;

 var right_col = col + widget_grid_data.size_x - 1;
if (right_col > this.cols) {
return false;
}
if (max_row && max_row < row + widget_grid_data.size_y - 1) {
return false;
}
this.for_each_cell_occupied(future_wd, function(tcol, trow) {
var $tw = this.is_widget(tcol, trow);
if ($tw && (!widget_grid_data.el || $tw.is($w))) {
result = false;
}
});
return result;
};

fn.get_targeted_columns = function(from_col) {
var max = (from_col || this.player_grid_data.col) +
(this.player_grid_data.size_x - 1);
var cols = [];
for (var col = from_col; col <= max; col++) {
cols.push(col);
}
return cols;
};

fn.get_targeted_rows = function(from_row) {
var max = (from_row || this.player_grid_data.row) +
(this.player_grid_data.size_y - 1);
var rows = [];
for (var row = from_row; row <= max; row++) {
rows.push(row);
}
return rows;
};

fn.get_cells_occupied = function(el_grid_data) {
var cells = { cols: [], rows: []};
var i;
if (arguments[1] instanceof $) {
el_grid_data = arguments[1].coords().grid;
}
for (i = 0; i < el_grid_data.size_x; i++) {
var col = el_grid_data.col + i;
cells.cols.push(col);
}
for (i = 0; i < el_grid_data.size_y; i++) {
var row = el_grid_data.row + i;
cells.rows.push(row);
}
return cells;
};

fn.for_each_cell_occupied = function(grid_data, callback) {
this.for_each_column_occupied(grid_data, function(col) {
this.for_each_row_occupied(grid_data, function(row) {
callback.call(this, col, row);
});
});
return this;
};

fn.for_each_column_occupied = function(el_grid_data, callback) {
for (var i = 0; i < el_grid_data.size_x; i++) {
var col = el_grid_data.col + i;
callback.call(this, col, el_grid_data);
}
};

fn.for_each_row_occupied = function(el_grid_data, callback) {
for (var i = 0; i < el_grid_data.size_y; i++) {
var row = el_grid_data.row + i;
callback.call(this, row, el_grid_data);
}
};
fn._traversing_widgets = function(type, direction, col, row, callback) {
var ga = this.gridmap;
if (!ga[col]) { return; }
var cr, max;
var action = type + '/' + direction;
if (arguments[2] instanceof $) {
var el_grid_data = arguments[2].coords().grid;
col = el_grid_data.col;
row = el_grid_data.row;
callback = arguments[3];
}
var matched = [];
var trow = row;
var methods = {
'for_each/above': function() {
while (trow--) {
if (trow > 0 && this.is_widget(col, trow) &&
$.inArray(ga[col][trow], matched) === -1
) {
cr = callback.call(ga[col][trow], col, trow);
matched.push(ga[col][trow]);
if (cr) { break; }
}
}
},
'for_each/below': function() {
for (trow = row + 1, max = ga[col].length; trow < max; trow++) {
if (this.is_widget(col, trow) &&
$.inArray(ga[col][trow], matched) === -1
) {
cr = callback.call(ga[col][trow], col, trow);
matched.push(ga[col][trow]);
if (cr) { break; }
}
}
}
};
if (methods[action]) {
methods[action].call(this);
}
};

fn.for_each_widget_above = function(col, row, callback) {
this._traversing_widgets('for_each', 'above', col, row, callback);
return this;
};

fn.for_each_widget_below = function(col, row, callback) {
this._traversing_widgets('for_each', 'below', col, row, callback);
return this;
};

fn.get_highest_occupied_cell = function() {
var r;
var gm = this.gridmap;
var rl = gm[1].length;
var rows = [], cols = [];
var row_in_col = [];
for (var c = gm.length - 1; c >= 1; c--) {
for (r = rl - 1; r >= 1; r--) {
if (this.is_widget(c, r)) {
rows.push(r);
cols.push(c);
break;
}
}
}
return {
col: Math.max.apply(Math, cols),
row: Math.max.apply(Math, rows)
};
};
fn.get_widgets_from = function(col, row) {
var ga = this.gridmap;
var $widgets = $();
if (col) {
$widgets = $widgets.add(
this.$widgets.filter(function() {
var tcol = $(this).attr('data-col');
return (tcol === col || tcol > col);
})
);
}
if (row) {
$widgets = $widgets.add(
this.$widgets.filter(function() {
var trow = $(this).attr('data-row');
return (trow === row || trow > row);
})
);
}
return $widgets;
};

fn.set_dom_grid_height = function(height) {
if (typeof height === 'undefined') {
var r = this.get_highest_occupied_cell().row;
height = r * this.min_widget_height;
}
this.container_height = height;
this.$el.css('height', this.container_height);
return this;
};

fn.set_dom_grid_width = function(cols) {
if (typeof cols === 'undefined') {
cols = this.get_highest_occupied_cell().col;
}
var max_cols = (this.options.autogrow_cols ? this.options.max_cols :
this.cols);
cols = Math.min(max_cols, Math.max(cols, this.options.min_cols));
this.container_width = cols * this.min_widget_width;
this.$el.css('width', this.container_width);
return this;
};

fn.generate_stylesheet = function(opts) {
var styles = '';
var max_size_x = this.options.max_size_x || this.cols;
var max_rows = 0;
var max_cols = 0;
var i;
var rules;
opts || (opts = {});
opts.cols || (opts.cols = this.cols);
opts.rows || (opts.rows = this.rows);
opts.namespace || (opts.namespace = this.options.namespace);
opts.widget_base_dimensions ||
(opts.widget_base_dimensions = this.options.widget_base_dimensions);
opts.widget_margins ||
(opts.widget_margins = this.options.widget_margins);
opts.min_widget_width = (opts.widget_margins[0] * 2) +
opts.widget_base_dimensions[0];
opts.min_widget_height = (opts.widget_margins[1] * 2) +
opts.widget_base_dimensions[1];

 var serialized_opts = $.param(opts);
if ($.inArray(serialized_opts, Gridster.generated_stylesheets) >= 0) {
return false;
}
this.generated_stylesheets.push(serialized_opts);
Gridster.generated_stylesheets.push(serialized_opts);

for (i = opts.cols; i >= 0; i--) {
styles += (opts.namespace + ' [data-col="'+ (i + 1) + '"] { left:' +
((i * opts.widget_base_dimensions[0]) +
(i * opts.widget_margins[0]) +
((i + 1) * opts.widget_margins[0])) + 'px; }\n');
}

for (i = opts.rows; i >= 0; i--) {
styles += (opts.namespace + ' [data-row="' + (i + 1) + '"] { top:' +
((i * opts.widget_base_dimensions[1]) +
(i * opts.widget_margins[1]) +
((i + 1) * opts.widget_margins[1]) ) + 'px; }\n');
}
for (var y = 1; y <= opts.rows; y++) {
styles += (opts.namespace + ' [data-sizey="' + y + '"] { height:' +
(y * opts.widget_base_dimensions[1] +
(y - 1) * (opts.widget_margins[1] * 2)) + 'px; }\n');
}
for (var x = 1; x <= max_size_x; x++) {
styles += (opts.namespace + ' [data-sizex="' + x + '"] { width:' +
(x * opts.widget_base_dimensions[0] +
(x - 1) * (opts.widget_margins[0] * 2)) + 'px; }\n');
}
this.remove_style_tags();
return this.add_style_tag(styles);
};

fn.add_style_tag = function(css) {
var d = document;
var tag = d.createElement('style');
d.getElementsByTagName('head')[0].appendChild(tag);
tag.setAttribute('type', 'text/css');
if (tag.styleSheet) {
tag.styleSheet.cssText = css;
} else {
tag.appendChild(document.createTextNode(css));
}
this.$style_tags = this.$style_tags.add(tag);
return this;
};

fn.remove_style_tags = function() {
var all_styles = Gridster.generated_stylesheets;
var ins_styles = this.generated_stylesheets;
this.$style_tags.remove();
Gridster.generated_stylesheets = $.map(all_styles, function(s) {
if ($.inArray(s, ins_styles) === -1) { return s; }
});
};

fn.generate_faux_grid = function(rows, cols) {
this.faux_grid = [];
this.gridmap = [];
var col;
var row;
for (col = cols; col > 0; col--) {
this.gridmap[col] = [];
for (row = rows; row > 0; row--) {
this.add_faux_cell(row, col);
}
}
return this;
};

fn.add_faux_cell = function(row, col) {
var coords = $({
left: this.baseX + ((col - 1) * this.min_widget_width),
top: this.baseY + (row -1) * this.min_widget_height,
width: this.min_widget_width,
height: this.min_widget_height,
col: col,
row: row,
original_col: col,
original_row: row
}).coords();
if (!$.isArray(this.gridmap[col])) {
this.gridmap[col] = [];
}
this.gridmap[col][row] = false;
this.faux_grid.push(coords);
return this;
};

fn.add_faux_rows = function(rows) {
var actual_rows = this.rows;
var max_rows = actual_rows + (rows || 1);
for (var r = max_rows; r > actual_rows; r--) {
for (var c = this.cols; c >= 1; c--) {
this.add_faux_cell(r, c);
}
}
this.rows = max_rows;
if (this.options.autogenerate_stylesheet) {
this.generate_stylesheet();
}
return this;
};

fn.add_faux_cols = function(cols) {
var actual_cols = this.cols;
var max_cols = actual_cols + (cols || 1);
max_cols = Math.min(max_cols, this.options.max_cols);
for (var c = actual_cols + 1; c <= max_cols; c++) {
for (var r = this.rows; r >= 1; r--) {
this.add_faux_cell(r, c);
}
}
this.cols = max_cols;
if (this.options.autogenerate_stylesheet) {
this.generate_stylesheet();
}
return this;
};

fn.recalculate_faux_grid = function() {
var aw = this.$wrapper.width();
this.baseX = ($(window).width() - aw) / 2;
this.baseY = this.$wrapper.offset().top;
$.each(this.faux_grid, $.proxy(function(i, coords) {
this.faux_grid[i] = coords.update({
left: this.baseX + (coords.data.col -1) * this.min_widget_width,
top: this.baseY + (coords.data.row -1) * this.min_widget_height
});
}, this));
return this;
};

fn.get_widgets_from_DOM = function() {
var widgets_coords = this.$widgets.map($.proxy(function(i, widget) {
var $w = $(widget);
return this.dom_to_coords($w);
}, this));
widgets_coords = Gridster.sort_by_row_and_col_asc(widgets_coords);
var changes = $(widgets_coords).map($.proxy(function(i, wgd) {
return this.register_widget(wgd) || null;
}, this));
if (changes.length) {
this.$el.trigger('gridster:positionschanged');
}
return this;
};

fn.generate_grid_and_stylesheet = function() {
var aw = this.$wrapper.width();
var max_cols = this.options.max_cols;
var cols = Math.floor(aw / this.min_widget_width) +
this.options.extra_cols;
var actual_cols = this.$widgets.map(function() {
return $(this).attr('data-col');
}).get();

 actual_cols.length || (actual_cols = [0]);
var min_cols = Math.max.apply(Math, actual_cols);
this.cols = Math.max(min_cols, cols, this.options.min_cols);
if (max_cols !== Infinity && max_cols >= min_cols && max_cols < this.cols) {
this.cols = max_cols;
}

 var max_rows = this.options.extra_rows;
this.$widgets.each(function(i, w) {
max_rows += (+$(w).attr('data-sizey'));
});
this.rows = Math.max(max_rows, this.options.min_rows);
this.baseX = ($(window).width() - aw) / 2;
this.baseY = this.$wrapper.offset().top;
if (this.options.autogenerate_stylesheet) {
this.generate_stylesheet();
}
return this.generate_faux_grid(this.rows, this.cols);
};

fn.destroy = function(remove) {
this.$el.removeData('gridster');

 $(window).unbind('.gridster');
if (this.drag_api) {
this.drag_api.destroy();
}
this.remove_style_tags();
remove && this.$el.remove();
return this;
};
fn.resize_widget_dimensions = function(options) {
if (options.widget_margins) {
this.options.widget_margins = options.widget_margins;
}
if (options.widget_base_dimensions) {
this.options.widget_base_dimensions = options.widget_base_dimensions;
}
this.min_widget_width = (this.options.widget_margins[0] * 2)
+ this.options.widget_base_dimensions[0];
this.min_widget_height = (this.options.widget_margins[1] * 2)
+ this.options.widget_base_dimensions[1];
var serializedGrid = this.serialize();
this.$widgets.each($.proxy(function(i, widget) {
var $widget = $(widget);
var data = serializedGrid[i];
this.resize_widget($widget, data.sizex, data.sizey);
}, this));
this.generate_grid_and_stylesheet();
this.get_widgets_from_DOM();
this.set_dom_grid_height();
this.set_dom_grid_width();
return false;
};

 $.fn.gridster = function(options) {
return this.each(function() {
if (! $(this).data('gridster')) {
$(this).data('gridster', new Gridster( this, options ));
}
});
};
return Gridster;
}));
