<h1 class="page_title">Edit question <?= $id ?></h1>
<?php echo validation_errors(); ?>
<?= form_open('/index.php/questions/edit/' . $id . '?test_id=' . $test_id) ?>
    <p class="form_labels">Text:</p>
    <?= form_textarea(array('name' => 'text', 'value' => $text, 'class' => 'input_areas', 'rows' => '3', 'cols' => '100')); ?>
    
    <p class="form_labels">Test id: </p>
    <?= form_input(array('name' => 'test_id', 'value' => $test_id, 'class' => 'input_fields')); ?>
    
    <p class="form_labels">Complexity: </p>
    <?= form_input(array('name' => 'complexity', 'value' => $complexity, 'class' => 'input_fields')); ?>
    
    <br />
    
    <!--Div that will hold the pie chart-->
    <div id="chart_div" style="float: right;"></div>
    
    <p class="form_labels">Answers:</p>
    
    <table align="center" width="100%" border="1" class="tables">
        <thead>
            <tr class="table_headers">
                <td>Id
                <td width="70%">Text
                <td>Right
                <td>Delete
            </tr>
        </thead>
        <tbody>
            <? foreach($answers as $each): ?>
            <tr onclick="window.location = '<?= base_url() . 'index.php/answers/edit/' . $each['id']; ?>'">
                <td><?= $each['id'] ?>
                <td><?= $each['text'] ?>
                <td><? if ($each['right'] == 1){ echo 'true';} else {echo 'false';} ?>
                <td><?=anchor('index.php/answers/delete/' . $each['id'],'delete',array('class' => 'crud_links'));?>
            </tr>
            <? endforeach ?>
        </tbody>
    </table>
<?= form_submit(array('value' => 'Save question', 'class' => 'buttons')) ?>
<input type="button" class="buttons" value="Add answer" onclick="document.location='<?= base_url() . 'index.php/answers/add?question_id=' . $id ?>'" />
<?= form_close() ?>


    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        
        //get array
        var response  = <?=$graph_values?>;
        var jsonText = JSON.stringify(response);
        var results = eval('(' + jsonText + ')');
        // Create the data table.        
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Topping');
        data.addColumn('number', 'Item Characteristic Curve');
        data.addColumn('number', 'Information Function');
        
        arr = [];
        for(var i=0; i < results.length; i++){
            arr.push([ results[i]['x'], results[i]['y'], results[i]['f']])    
        }

        data.addRows(arr);

        // Set chart options
        var options = {'title':'Item Characteristic Curve and Information function',
                       'width':800,
                       'height':500,
                       'backgroundColor': '#fff'
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
