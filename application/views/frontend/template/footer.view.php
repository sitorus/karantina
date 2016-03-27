<?php
	$sess = $this->session->userdata("lang");
	//print_r($sitemap);
	$footer = isset($sitemap["footer"])?$sitemap["footer"]:"";
?>
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row sidebar">
		<?php
        foreach( $footer as $rf )
		{
		?>
        <aside class="col-xs-12 col-sm-6 col-md-3 widget links">
		  <div class="title-block">
			<h3 class="title"><?php echo $sess=="id"?$rf->title_id:$rf->title_en ?></h3>
		  </div>
		  <nav>
			<ul>
              <?php foreach( $rf->sub_sitemap as $rss ){ ?>
			  <li><a href="#"><?php echo $sess=="id"?$rss->title_id:$rss->title_en; ?></a></li>
              <?php } ?>
			</ul>
		  </nav>
        </aside>
		<?php
		}
		?>
		
      </div>
    </div>
  </div><!-- .footer-top -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="copyright col-xs-12 col-sm-3 col-md-3">
		  Copyright © Komisi Yudisial., 2015
		</div>
		
        <div class="phone col-xs-6 col-sm-3 col-md-3">
          <div class="footer-icon">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
			  <path fill="#c6c6c6" d="M11.001,0H5C3.896,0,3,0.896,3,2c0,0.273,0,11.727,0,12c0,1.104,0.896,2,2,2h6c1.104,0,2-0.896,2-2
			   c0-0.273,0-11.727,0-12C13.001,0.896,12.105,0,11.001,0z M8,15c-0.552,0-1-0.447-1-1s0.448-1,1-1s1,0.447,1,1S8.553,15,8,15z
				M11.001,12H5V2h6V12z"></path>
			</svg>
		  </div>
          <strong class="title">Call Us:</strong> (021)3905876 
          <strong>or</strong> (021)3905876 <br />
          Fax. (021)3906215. PO BOX 2685 <br />
          Email : kyri[at]komisiyudisial.go.id
        </div>
		
        <div class="address col-xs-6 col-sm-3 col-md-3">
          <div class="footer-icon">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
			  <g>
				<g>
				  <path fill="#c6c6c6" d="M8,16c-0.256,0-0.512-0.098-0.707-0.293C7.077,15.491,2,10.364,2,6c0-3.309,2.691-6,6-6
					c3.309,0,6,2.691,6,6c0,4.364-5.077,9.491-5.293,9.707C8.512,15.902,8.256,16,8,16z M8,2C5.795,2,4,3.794,4,6
					c0,2.496,2.459,5.799,4,7.536c1.541-1.737,4-5.04,4-7.536C12.001,3.794,10.206,2,8,2z"></path>
				</g>
				<g>
				  <circle fill="#c6c6c6" cx="8.001" cy="6" r="2"></circle>
				</g>
			  </g>
			</svg>
		  </div>
          	Komisi Yudisial Republik Indonesia <br>
            Jl. Kramat Raya No. 57, Jakarta Pusat
        </div>
		
        <div class="col-xs-12 col-sm-3 col-md-3">
          <a href="#" class="up">
			<span class="glyphicon glyphicon-arrow-up"></span>
		  </a>
        </div>
      </div>
    </div>
  </div><!-- .footer-bottom -->
</footer>