<h1 class="page_title">User list</h1>

<? $CI = &get_instance(); ?>

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
                    header = '<table width="100%" class="tables" border="1"><thead><tr><td>Id<td>Name<td>Email<td>Group<td>Delete</thead><tbody>';
                    for(var i=0; i < results.length; i++){
                        var id = results[i]["group_id"];
                        table = table + '<tr onclick="window.location = ' + '\'<?=base_url().'index.php/users/show/'?>' + results[i]["id"] + '\'"><td>' + results[i]["id"] + 
                        '<td>' + results[i]["name"] + 
                        '<td>' + results[i]["email"] + 
                        '<td>' + document.getElementById('group_name').options[id-1].innerHTML + 
                        '<td>' + '<?='<a href='.base_url().'index.php/users/delete/';?>' + results[i]['id'] + '>delete</a></tr>';
                    }
                    document.getElementById('testing_table').innerHTML = header + table + '</tbody></table>';
                    decorate();
                }
    		}
    	}
        request = 'http://localhost/testing/index.php/users/filtred_by_group/' + document.getElementById('group_name').value;
    	req.open('GET', request, true);
    	req.send(null);
    }
</script>

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

<table align="center" width="100%" border="1" class="tables" id="testing_table">
    <thead>
        <tr>
            <td>Id
            <td>Name
            <td>Email
            <td>Group
            <td>Delete
        </tr>
    </thead>
    <tbody>
        <?php 
            $list = $this->mdl_user->getlist();
            $size = count($list);
            $CI = &get_instance();
        ?>
        <?foreach ($list as $each):?>
            <tr onclick="window.location = '<?= base_url() . 'index.php/users/show/' . $each['id']; ?>'">
            <td> <?=$each['id'];?>
            <td> <?=anchor('index.php/users/show/'.$each['id'], $each['name']);?>
            <td> <?=$each['email'];?>
            <? 
                $CI->db->where('id', $each['group_id']);
                $request = $CI->db->get('groups');
                $group_name = $request->row()->name;
            ?>
            <td> <?=anchor('index.php/groups/edit/'.$each['group_id'], $group_name);?>
                
            <td width="10%"><?=anchor('index.php/users/delete/' . $each['id'],'delete',array('class' => 'crud_links'));?>
        <?endforeach?>  
    </tbody>
</table>