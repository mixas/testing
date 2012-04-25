<?
/**
 * show results about test
 */
?>
<?
    $CI = &get_instance();
?>

<script type="text/javascript">
    function filter(){
        var req = getXmlHttp()
    	
    	req.onreadystatechange = function(){
    		if (req.readyState == 4){
                if(req.status == 200){
                    var response  = req.responseText;
                    var myObject = eval('(' + response + ')');
                    var results = myObject["results"];
                    var table = '';
                    header = '<table width="100%" class="tables" border="1"><thead><tr><td>User name <td>Group <td>Right answers count <td> User raiting (maximum 100 points)</thead><tbody>';
                    for(var i=0;i<results.length;i++){
                        var id = results[i]["group_id"];
                        table = table + '<tr><td>' + results[i]["name"] + 
                        '<td>' + document.getElementById('group_name').options[id-1].innerHTML + 
                        '<td>' + results[i]["right_answers"] + 
                        '<td>' + results[i]["user_level"] + '</tr>';
                    }
                    document.getElementById('testing_table').innerHTML = header + table + '</tbody></table>';
                    decorate();
                }
    		}
    	}
        request = 'http://localhost/testing/index.php/tests/get_filtred_results/' + <?= $test_id ?> + '?group=' +
        document.getElementById('group_name').value;
    	req.open('GET', request, true);
    	req.send(null);
    }
</script>

<h1 class="page_title">Results for <?= $test_id ?> test</h1>

<!-- drop down with groups -->
<?
    $options = array();
    $request = $CI->db->get('groups');
    $groups = $request->result();
    foreach($groups as $each){
        $options[$each->id] = $each->name;
    }
?>
<p class="form_labels">Select group:</p>
<?= form_dropdown('group', $options, $options[2], 'class="selected_fields" id="group_name" onChange="filter()"') ?>
<br /><br />

<!-- table with results -->
<table align="center" width="100%" border="1" class="tables" id="testing_table">
    <thead>
        <tr>
            <td>User name
            <td>Group
            <td>Right answers count
            <td>User raiting (maximum 100 points)
        </tr>
    </thead>
    <tbody>
        <?foreach ($results as $each):?>
            <tr>
                <td> <?= $each->name;?>
                <td><? 
                    $CI->db->where('id', $each->group_id);
                    $request = $CI->db->get('groups');
                    $group = $request->row();
                    echo $group->name;
                    ?>
                
                <td> <?= $each->right_answers;?>
                <td> <?= $each->user_level;?>
            </tr>
        <?endforeach?>
    </tbody>
</table>

<p class="form_labels"><? if ($results){
        echo 'Total questions count in this test is <b>' . $results[0]->count_of_questions . '</b>';
    } 
    else{
        echo "This test have not any results";
    } ?></p>