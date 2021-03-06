<?php
	$sess = $this->session->userdata("lang");
	$procurement = isset($procurement)?$procurement:"";
	$detail_tag = isset($detail_tag)?$detail_tag:"";
	$row = isset($procurement[0])?$procurement[0]:"";
	$title = $sess=="id"?$row->title_id:$row->title_en;
	$text = $sess=="id"?$row->text_id:$row->text_en;
	$date = TglOnlyIndo($row->modified_date);
	$file = isset($row->file)?$row->file:"";
?>
<section id="main">
  <header class="page-header">
    <div class="container">
      <h3 class="title"><?php echo $title; ?></h3>
    </div>	
  </header>
  <div class="container">
    <div class="row">
      <div class="content blog blog-post col-sm-12 col-md-12">
		<procurement class="post">
		  <div class="entry-content" style="text-align:justify;">
			<?php echo $text; ?>
		  </div>
		  <footer class="entry-meta">
			<span class="time"><?php echo $sess=="id"?"Tanggal Posting: ":"Posting Date: " ?><?php echo $date ?></span> | 
            <span class="time">
            <?php if( !empty($file) ){ ?>
            	<a href="<?php echo base_url() ?>assets/uploads/files/<?php echo $file ?>" target="_blank">
					<i class="fa fa-download"></i> <?php echo $sess=="id"?"Unduh":"Download" ?>
                </a>
            <?php } ?>
            </span>
		  </footer>
		</procurement><!-- .post -->
	
		
      </div><!-- .content -->
    </div>
  </div><!-- .container -->
</section><!-- #main -->