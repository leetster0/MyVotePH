<script>
plot();
fetch_recent();
fetch_top();
</script>

<div class="container" width="700">
    <br>
    <div class="section">
        Twitter Activity
    </div>
    <div id="graph">
        <div id="loading">
            <br>
            Loading...
        </div>
        
        <canvas id="myChart" width="700" height="500"></canvas>
        
    </div>
    <br>
    
    <div class="section">
        Recent Tweets
    </div>
    <br>
    
    <div id="loading1">
        Loading...
    </div>
    
    <table id="table" class="table" style="width:700px">
        
        <tr style="<?=$style?>" class="tablehead"> 
        <td>User</td>
        <td>Tweet</td>
        <td>Time</td>
        
        </tr>
    </table>


<div class="section">
        Top Tweets
    </div>
    <br>
    
    <div id="loading2">
        Loading...
    </div>
    
    <table id="table1" class="table" style="width:700px" style="<?=$style?>">
        <tr style="<?=$style?>" class="tablehead"> 
        <td>User</td>
        <td>Tweet</td>
        <td>Time</td>
        
        </tr>
    </table>