
<div style="height: 70px; background-color: <?php echo $demo->farba_blok ?>; padding-top: 4px;">
	<h3 style="color: <?php echo $demo->farba_text_blok ?>; text-align: center; ">Dobrý deň,<br>{{ $demo->receiver }}</h3>
</div>


<p style="color: <?php echo $demo->farba_text ?>; text-align: center">
	na predmete Webove technologie 2 budete mat k dispozicii vlastny virtualny linux server, ktory budete pouzivat pocas
	semestra, a na ktorom budete vypracovavat zadania. Prihlasovacie udaje k Vasmu serveru su uvedene nizsie.
	To ako sa prihlasit a ako so serverom pracovat sa dozviete na prvych cviceniach.
</p>

<h4 style="color: <?php echo $demo->farba_text ?>; font-weight: bold; text-align: center"><b>Údaje k Vašemu serveru</b></h4>


<div style="text-align: center;">
	@php
		$hlavicka = $demo->hlavicka;
		$other = $demo->other;
	@endphp

	@for($i =  0; $i < count($other); $i++)
		<p style="color: <?php echo $demo->farba_text ?>;"><b>{{$hlavicka[$i]}}: </b>{{ $other[$i] }}</p>
	@endfor

	<p style="color: <?php echo $demo->farba_text ?>"><b>prihlasovacie meno:</b><a style="color: <?php echo $demo->farba_text ?>">&nbsp;{{ $demo->login }} </a></p>
	<p style="color: <?php echo $demo->farba_text ?>;"><b>heslo:</b><a style="color: <?php echo $demo->farba_text?>">&nbsp;{{ $demo->password }} </a></p>
</div>

<div style="height: 70px; background-color: <?php echo $demo->farba_blok ?>; text-align: center; padding-top: 5px;">
	<p style="color: <?php echo $demo->farba_text_blok ?>; ">S pozdravom, <br>
	<i>{{ $demo->sender }}</i></p>
</div>




