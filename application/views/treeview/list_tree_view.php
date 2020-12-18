
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Tree View</title>
    <!-- Bootstrap Core Css -->
    <link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
  	<div class="container">
    	<h1>Bootstrap Tree View</h1>
      <br>
      <div class="row">
        <div class="col-sm-4">
          <h2>Collapsed</h2>
          <div id="treeview1" class=""></div>
        </div>
      </div>
      <br/>
      <br/>
      <br/>
      <br/>
    </div>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery.js"></script>
  	<script src="<?=base_url()?>assets/js/bootstrap-treeview.js"></script>
  	<script type="text/javascript">

  		$(function() {
        $('#treeview1').treeview({
          levels: 1,
          data: [{
            text: 'Parent 1',
            href: '#parent1',
            tags: ['1'],
            nodes: [
              {
                text: 'Child 1',
                href: '#child1',
                tags: ['2'],
                nodes: [
                  {
                    text: 'Grandchild 1',
                    href: '#grandchild1',
                    tags: ['0']
                  },
                  {
                    text: 'Grandchild 2',
                    href: '#grandchild2',
                    tags: ['0']
                  }
                ]
              },
              {
                text: 'Child 2',
                href: '#child2',
                tags: ['0']
              }
            ]
          },
          {
            text: 'Parent 2',
            href: '#parent2',
            tags: ['0']
          },
          {
            text: 'Parent 3',
            href: '#parent3',
             tags: ['0']
          },
          {
            text: 'Parent 4',
            href: '#parent4',
            tags: ['0']
          },
          {
            text: 'Parent 5',
            href: '#parent5'  ,
            tags: ['0']
          }
          ]
        });
  		});
  	</script>
  </body>
</html>
