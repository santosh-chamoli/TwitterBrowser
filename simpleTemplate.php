<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple Twitter Browser</title>
        <style>
            table {border-collapse:collapse;}
            table td {border:solid 2px #fab; overflow-wrap: break-word;word-wrap: break-word;}
            table th {border:solid 2px #fab; overflow-wrap: break-word;word-wrap: break-word;}
            body {
                background-color: #48D1CC;
                padding-left: 20%;
                padding-right: 20%;
                height:100%
            }
        </style>
        <script>
            function clearbox(id) {
                if (document.getElementById(id).value === 'Enter Search Text') {
                    document.getElementById(id).value = '';
                }
            }
        </script>
    </head>
    <body>
        <h1>Simple Twitter Browser</h1>
        <form action ="index.php" method="post">
            <input type="radio" name="search_type" value="tag"> search hashtag<br>
            <input type="radio" name="search_type" value="retweet"> search retweets<br>
            <input type="text" id= "textbox1" name="q" value="Enter Search Text" onfocus="clearbox(this.id)"><br>
            <input type="hidden" name="posted_form" value ="1">
            <input type="submit"><br><br>
        </form>
        <?php
            if(!empty($this->data)) {
                $content = '<table style="border: 1px solid black;">
                    <tr>
                        <th>Tweet Id</th>
                        <th>User</th>
                        <th>Text</th> 
                        <th>Retweet Count</th>
                    </tr>';
                foreach($this->data as $tweet) {
                    $row = '<tr>';
                    $row = $row . '<td>' . $tweet['tweet_id']. '</td>';
                    $row = $row . '<td>' . $tweet['user']. '</td>';
                    $row = $row . '<td>' . $tweet['text']. '</td>';
                    $row = $row . '<td>' . $tweet['retweet_count']. '</td>';
                    $row .= '</tr>';
                    $content .= $row;
                }
                $content .= '</table>';
                echo $content;
            }
        ?>
    </body>
</html>
