Zdravim, <a style="color: <?php echo $demo->farba_receiver?>">{{ $demo->receiver }}</a>
<p>
    na predmete Webove technologie 2 budete mat k dispozicii vlastny virtualny linux server, ktory budete pouzivat pocas
    semestra, a na ktorom budete vypracovavat zadania. Prihlasovacie udaje k Vasmu serveru su uvedene nizsie.
    To ako sa prihlasit a ako so serverom pracovat sa dozviete na prvych cviceniach.
</p>

<p><u>Údaje k Vašemu serveru:</u></p>

<div>
    <p><b>ip adresa:</b><a style="color: <?php echo $demo->farba_ip_adresa?>"> &nbsp;{{ $demo->ip_adresa }} </a></p>
    <p><b>ssh port:</b><a style="color: <?php echo $demo->farba_ssh_port?>"> &nbsp;{{ $demo->ssh_port }} </a></p>
    <p><b>http port::</b><a style="color: <?php echo $demo->farba_http_port?>">&nbsp;{{ $demo->http_port }} </a></p>
    <p><b>https port:</b><a style="color: <?php echo $demo->farba_https_port?>">&nbsp;{{ $demo->https_port }} </a></p>
    <p><b>misc1 port:</b><a style="color: <?php echo$demo->farba_misc_1_port?>">&nbsp;{{ $demo->misc_1_port }} </a></p>
    <p><b>misc2 port:</b><a style="color: <?php echo $demo->farba_misc_2_port?>">&nbsp;{{ $demo->misc_2_port }} </a></p>
    <p><b>prihlasovacie meno:</b><a style="color: <?php echo $demo->farba_login?>">&nbsp;{{ $demo->login }} </a></p>
    <p><b>heslo:</b><a style="color: <?php echo $demo->farba_password?>">&nbsp;{{ $demo->password }} </a></p>

    <p>
        Vase web stranky budu dostupne na: http://{{ $demo->ip_adresa }}:{{ $demo->http_port }}/ resp. https://{{ $demo->ip_adresa }}:{{ $demo->https_port }}/
    </p>

</div>

S pozdravom, <i>{{ $demo->sender }}</i>

