<!-- 
variable : nama, nilai, grade

jika nilai 
>= 85 <= 100: grade = A
>=75 && <= 85: grade =B
>=60 & < 75: grade =C
>=30 & < 60: grade=D
>= 0 & < 30: grade =E
-->
<?php




$nama = "Azhar Fikri";
$nilai = 90;


if($nilai >=85 && $nilai <=100 )
    // echo "Nama $nama, nilai nya : $nilai, Grade nya : $grade = A";
    $grade = "A";
else if($nilai >=75 && $nilai <=85)
    // echo "Nama $nama, nilai nya : $nilai, Grade nya : B";
    $grade = "B";
else if($nilai >=60 && $nilai <75)
    // echo "Nama $nama, nilai nya : $nilai, Grade nya : C";
    $grade = "C";
else if($nilai >=30 && $nilai <60)
    // echo "Nama $nama, nilai nya : $nilai, Grade nya : D";
    $grade = "D";
else if($nilai >=0 && $nilai < 30)
    // echo "Nama $nama, nilai nya : $nilai, Grade nya : E";
    $grade = "E";
else
    // echo "Tidak Valid";
    $grade = "";

echo "<br>";

switch($grade){
    case "A": 
     $predikat = 'Memuaskan';
     echo "<H3 style='color:red';>$predikat </H3>";
     break;
    case "B": 
     $predikat = 'Bagus';
     echo $predikat;
     break;
    case "C": 
     $predikat = 'Cukup';
     echo $predikat;
     break;
    case "D": 
    $predikat = 'kurang';
     echo $predikat;
     break;
    case "E": 
     $predikat = 'Buruk';
     echo $predikat;
     break;
    default:
     echo "tidak valid";
     break;
    
}
echo $nama;
echo '<br>';
echo $nilai;
echo '<br>';
echo $grade;
echo '<br>';
echo $predikat;


?>