<?php
$numbers=range(1,50);
$evens=[];
foreach($numbers as $n){if($n%2==0){$evens[]=$n;}}
$evenNumbers="Even Numbers: ".implode(" - ",$evens);

$form=<<<FORM
<form>
<div class="mb-3">
<label for="e" class="form-label">Email address</label>
<input type="email" class="form-control" id="e" placeholder="name@example.com">
</div>
<div class="mb-3">
<label for="t" class="form-label">Example textarea</label>
<textarea class="form-control" id="t" rows="3"></textarea>
</div>
</form>
FORM;

function createTable($r,$c){
$t="<table class='table table-bordered'>";
for($i=1;$i<=$r;$i++){
$t.="<tr>";
for($j=1;$j<=$c;$j++){
$t.="<td>Row $i, Col $j</td>";
}
$t.="</tr>";
}
$t.="</table>";
return $t;}
?>
<!DOCTYPE html>
<html>
<head>
<title>PHP Assignment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
<?php
echo $evenNumbers;
echo $form;
echo createTable(8,6);
?>
</body>
</html>
