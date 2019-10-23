<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\wwwroot\YouQianHuan\public/../app/admin\view\index\index.html";i:1569361144;}*/ ?>
<div class="row">

<div class="col-md-6">
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">系统信息</h3>
        </div>
       
        <div class="box-body no-padding">
          <table class="table table-striped">
            <tbody>
                
            <tr>
              <td>有钱还版本</td>
              <td><?php echo $info['ob_version']; ?></td>
            </tr>  
            <tr>
              <td>ThinkPHP版本</td>
              <td><?php echo $info['think_version']; ?></td>
            </tr>
            <tr>
              <td>操作系统</td>
              <td><?php echo $info['os']; ?></td>
            </tr>
            <tr>
              <td>运行环境</td>
              <td><?php echo $info['software']; ?></td>
            </tr>
            <tr>
              <td>MySql版本</td>
              <td><?php echo $info['mysql_version']; ?></td>
            </tr>
            <tr>
              <td>PHP版本</td>
              <td><?php echo $info['php_version']; ?></td>
            </tr>
            <tr>
              <td>上传限制</td>
              <td><?php echo $info['upload_max']; ?></td>
            </tr>
          </tbody>
          </table>
        </div>
        
      </div>
         
    </div>



<div class="col-md-6">
    
    <div class="box">
        <div class="box-header">
          <h3 class="box-title">产品信息</h3>
        </div>
        
        <div class="box-body no-padding">
          <table class="table table-striped">
            <tbody>

            <tr>
              <td>产品名称</td>
              <td><!--<?php echo $info['product_name']; ?>-->有钱还开源版</td>
            </tr> 
            <tr>
              <td>产品设计及研发团队</td>
              <td><!--<?php echo $info['author']; ?>-->洛辰工作室</td>
            </tr>
            <tr>
              <td>官方网址</td>
              <td><a target="_blank" href="<?php echo base64_decode('aHR0cHM6Ly9iYnMuNWcteXVuLmNvbQ=='); ?>">洛辰工作室</a></td>
            </tr>
            <tr>
              <td>QQ</td>
              <td>3525726718</td>
            </tr>
            <tr>
              <td>技术支持</td>
              <td>洛辰工作室</td>
            </tr>
          </tbody>
          </table>
        </div>
      
      </div>
</div>
  
  </div>