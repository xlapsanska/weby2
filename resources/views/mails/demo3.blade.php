
<h2 class="text-center" style="color: <?php echo $demo->farba_text ?>;">Dobrý deň, {{ $demo->receiver }}</h2>

<hr>

<p style="color: <?php echo $demo->farba_text ?>; text-align: justify">
	na predmete Webove technologie 2 budete mat k dispozicii vlastny virtualny linux server, ktory budete pouzivat pocas
	semestra, a na ktorom budete vypracovavat zadania. Prihlasovacie udaje k Vasmu serveru su uvedene nizsie.
	To ako sa prihlasit a ako so serverom pracovat sa dozviete na prvych cviceniach.
</p>

<h3 style="color: <?php echo $demo->farba_text ?>;"><b>Údaje k Vašemu serveru:</b></h3>

<div style="">
	@php
		$hlavicka = $demo->hlavicka;
		$other = $demo->other;
	@endphp

	<table style="color: <?php echo $demo->farba_text ?>; border: 1px solid <?php echo $demo->farba_text ?>; border-collapse: collapse; text-align: left">


	@for($i =  0; $i < count($other); $i++)
		<tr style="border: 1px solid <?php echo $demo->farba_text ?>;">
			<td style="border: 1px solid <?php echo $demo->farba_text ?>;">
				{{$hlavicka[$i]}}
			</td>
			<td style="border: 1px solid <?php echo $demo->farba_text ?>;">
				{{ $other[$i] }}
			</td>
		</tr>
	@endfor

		<tr>
			<td style="border: 1px solid <?php echo $demo->farba_text ?>;">
				Prihlasovacie meno
			</td>
			<td style="border: 1px solid <?php echo $demo->farba_text ?>;">
				&nbsp;{{ $demo->login }}
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid <?php echo $demo->farba_text ?>;">
				Heslo
			</td>
			<td style="border: 1px solid <?php echo $demo->farba_text ?>;">
				&nbsp;{{ $demo->password }}
			</td>
		</tr>
	</table>
</div>

<br>
<hr>
<br>
<p style="color: <?php echo $demo->farba_text ?>;">
S pozdravom, <br>
<i>{{ $demo->sender }}</i>
</p>

