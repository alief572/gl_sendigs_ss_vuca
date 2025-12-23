<style>
.pesan{
                display: none;
                position: fixed;
                border: 1px solid blue;
                width: 200px;
                top: 10px;
                left: 200px;
                padding: 5px 10px;
                background-color: lightskyblue;
                text-align: center;
            }
        </style>

<?php
    //        menampilkan pesan jika ada pesan
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                echo '<div class="pesan">'.$_SESSION['pesan'].'</div>';
            }
    //        mengatur session pesan menjadi kosong
            $_SESSION['pesan'] = '';
            ?>
	<script src="jquery.min.js"></script>
        <script>
//            angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
            $(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
//            angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
            setTimeout(function(){$(".pesan").fadeOut('slow');}, 3000);
        </script>