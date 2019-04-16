<?php
    if(isset($_POST['save_audio']) && $_POST['save_audio']=="Upload Audio")
    {
        $dir='uploads/';
        $audio_path=$dir.basename($_FILES['audioFile']['name']);

        if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_path))
        {
            echo 'uploaded succesfully' ;
            saveAudio($audio_path);
            displayAudios();
            

            
        }
        else{
            echo 'error';
        }
    }
    
    function saveAudio($fileName)
    {
        $conn=mysqli_connect('localhost', 'root','','audiolib');
        if(!$conn){
            die('server not connected');
        }
    
     $query="insert into audios(filename)values('{$fileName}')";
     mysqli_query($conn,$query);
     
     if(mysqli_affected_rows($conn)>0){
        
         echo "audio file path saved in database.";
     }
        mysqli_close($conn);
        
    }
    function displayAudios(){
        
        $conn=mysqli_connect('localhost', 'root','','audiolib');
        if(!$conn){
            die('server not connected');
        }
        
        $query="select * from audios";
        $r=mysqli_query($conn, $query);

        while($row=mysqli_fetch_array($r)){

           echo '<a href="play.php?name='.$row['filename'].'">'.$row['filename'].'</a>';
           echo "<br/>";
           

        }

        mysqli_close($conn);
    }


?>