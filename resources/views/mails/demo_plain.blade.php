Zdravim, {{ $demo->receiver }}

na predmete Webove technologie 2 budete mat k dispozicii vlastny virtualny linux server, ktory budete pouzivat pocas
semestra, a na ktorom budete vypracovavat zadania. Prihlasovacie udaje k Vasmu serveru su uvedene nizsie.
To ako sa prihlasit a ako so serverom pracovat sa dozviete na prvych cviceniach.


Údaje k Vašemu serveru:

ip adresa: {{ $demo->ip_adresa }}
ssh port: {{ $demo->ssh_port }}
http port: {{ $demo->http_port }}
https port: {{ $demo->https_port }}
misc1 port: {{ $demo->misc_1_port }}
misc2 port: {{ $demo->misc_2_port }}
prihlasovacie meno: {{ $demo->login }}
heslo: {{ $demo->password }}


Vase web stranky budu dostupne na: http://{{ $demo->ip_adresa }}:{{ $demo->http_port }}/ resp. https://{{ $demo->ip_adresa }}:{{ $demo->https_port }}/

S pozdravom, {{ $demo->sender }}

