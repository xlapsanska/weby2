
<div style="background-color: <?php echo $demo->farba_blok ?>; padding-top: 7px; padding-bottom: 7px; text-align: center;">
	<h3 style="color: <?php echo $demo->farba_text_blok ?>; text-align: center; ">Dobrý deň, {{ $demo->receiver }}</h3>
</div>

		<p style="color: <?php echo $demo->farba_text ?>; text-align: justify">
			na predmete Webove technologie 2 budete mat k dispozicii vlastny virtualny linux server, ktory budete pouzivat pocas
			semestra, a na ktorom budete vypracovavat zadania. Prihlasovacie udaje k Vasmu serveru su uvedene nizsie.
			To ako sa prihlasit a ako so serverom pracovat sa dozviete na prvych cviceniach.
		</p>

	<div style="background-color: <?php echo $demo->farba_blok ?>; padding: 7px; text-align: center;">
		<h4 style="color: <?php echo $demo->farba_text_blok ?>; font-weight: bold; text-align: center"><b>Údaje k Vašemu serveru</b></h4>
	@php
		$hlavicka = $demo->hlavicka;
		$other = $demo->other;
	@endphp

	@for($i =  0; $i < count($other); $i++)
		<p style="color: <?php echo $demo->farba_text_blok ?>;"><b>{{$hlavicka[$i]}}: </b>{{ $other[$i] }}</p>
	@endfor

	<p style="color: <?php echo $demo->farba_text_blok ?>;"><b>prihlasovacie meno:</b><a style="color: <?php echo $demo->farba_text_blok ?>;">&nbsp;{{ $demo->login }} </a></p>
	<p style="color: <?php echo $demo->farba_text_blok ?>;"><b>heslo:</b><a style="color: <?php echo $demo->farba_text_blok ?>;">&nbsp;{{ $demo->password }} </a></p>
</div>

<div style="text-align: center;">
	<p style="color: <?php echo $demo->farba_text ?>; text-align: center;">S pozdravom, <i>{{ $demo->sender }}</i></p>

</div>



