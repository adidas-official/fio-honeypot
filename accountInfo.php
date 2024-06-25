<div class="indexZustatkyBox">
    <div class="row">
        <div class="col-md-4">
            <div class="row balanceRow">
                <div class="col-sm-6 balanceLabel"> Disponibilní zůstatek: </div>
                <div class="col-sm-6 balanceSum availableBalance">
                    <!-- zustatek -->
                    <!-- 3&nbsp;540&nbsp;399,12&nbsp;CZK  -->
                    <?php echo $result[0]["balance_total"] ?>&nbsp;CZK <!-- TODO: rozdelit po tisicich -->
                </div>
            </div>
            <div class="row balanceRow">
                <div class="col-sm-6 balanceLabel"> Běžný zůstatek: </div>
                <div class="col-sm-6 balanceSum">
                    <!-- 151&nbsp;149,42&nbsp;CZK -->
                    <?php echo $result[0]["balance_total"] - $result[0]["blocked_funds"]; ?>&nbsp;CZK <!-- TODO: rozdelit po tisicich --> 
                </div>
            </div>
            <div>
                <div class="row balanceRow">
                    <div class="col-sm-6 balanceLabel"> Blokovaná částka: </div>
                    <!-- v databazi -->
                    <div class="col-sm-6 balanceSum">
                        <!-- 251,30&nbsp;CZK -->
                        <?php echo $result[0]["blocked_funds"] ?>&nbsp;CZK
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="border-left: 1px solid rgb(238, 238, 238); border-right: 1px solid rgb(238, 238, 238);">
            <div class="row">
                <div class="col-sm-4 balanceLabel"> Číslo účtu: </div>
                <!-- v databazi -->
                    <div class="col-sm-8 balanceSum"> <span><?php echo $result[0]["id_account"] ?> / 2010</span> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 balanceLabel"> IBAN: </div>
                <!-- Vytvori se z cisla uctu -->
                <div class="col-sm-8 balanceSum"> <span>
                    CZ58 2010 0000 00<?php echo $result[0]["id_account"] ?> <!-- TODO: rozdelit po 4 -->
                    <!-- CZ58 2010 0000 0028 1900 3243 -->
                </span> </div>
            </div>
            <div class="row">
                <div class="col-sm-4 balanceLabel"> BIC/SWIFT: </div>
                <!-- v databazi -->
                <div class="col-sm-8 balanceSum"> <span>
                    <?php echo $result[0]["swift"] ?>
                    <!-- FIOBCZPPXXX -->
                </span> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <div class="AdDashboardHeader">Spočítejte si hypotéku</div>
                <div class="AdDashboardText pull-left" style="width: 80%"><a target="_blank" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-zustatky-reklama-container-linkText"> <span>Pořiďte si hypotéku bez poplatků. Spočítejte si svoji splátku a snižte si její výši s Hypospořicím kontem.</span></a></div>
                <div class="AdSmallImg pull-right"> <a target="_blank" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-zustatky-reklama-container-linkObrazek"> <img src="./ib-fio_files/66x60_Fio_hypoteka_dum.png"> </a> </div>
            </div>
        </div>
    </div>
</div>
