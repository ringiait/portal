<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php $cats = get_the_category();?>
<article class="single-product-detail <?php echo 'category-'.$cats[0]->term_id;?>">    
	<div class="right-detail-product">   
        <?php 
            $link_category = get_category_link($cats[0]->term_id);
            if($cats[0]->slug == 've-chung-toi'){
                $link_category = 'http://sofa88.vn/ve-chung-toi';
            }
        ?>     
        <p class="link-category"><i class="fa fa-angle-left"></i></i><a href="<?php echo $link_category;?>"><?php echo $cats[0]->name;?></a></p>
        <header class="entry-header">
		  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          <?php if($cats[0]->slug == 'sofa-da-that' || $cats[0]->slug == 'sofa-da-ni'){ ?>
           <div class="box-list-price">
                <?php if($cats[0]->slug == 'sofa-da-that'){ ?>
                    <table>
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="bold-text">Da thật</td>
                                <td class="bold-text">Da ép</td>
                                <td class="bold-text">Da PU</td>
                            </tr>
                            <tr>
                                <td class="bold-text">K.T To</td>
                                <td><?php echo get_post_meta( get_the_ID(), 'Da that - KT To', true );?></td>
                                <td><?php echo get_post_meta( get_the_ID(), 'Da ep - KT To', true );?></td>
                                <td><?php echo get_post_meta( get_the_ID(), 'Da pu - KT To', true );?></td>
                            </tr>
                            <tr>
                                <td class="bold-text">K.T nhỏ</td>
                                <td><?php echo get_post_meta( get_the_ID(), 'Da that - KT Nho', true );?></td>
                                <td><?php echo get_post_meta( get_the_ID(), 'Da ep - KT Nho', true );?></td>
                                <td><?php echo get_post_meta( get_the_ID(), 'Da pu - KT Nho', true );?></td>
                            </tr>
                        </tbody>
                    </table>     
                  <?php }
                    else if($cats[0]->slug == 'sofa-da-ni'){?>
                         <table style="width: 61% !important;">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="bold-text">Giá</td>
                                </tr>
                                <tr>
                                    <td class="bold-text">K.T To</td>
                                    <td><?php echo get_post_meta( get_the_ID(), 'Da ni - KT To', true );?></td>
                                </tr>
                                <tr>
                                    <td class="bold-text">K.T nhỏ</td>
                                    <td><?php echo get_post_meta( get_the_ID(), 'Da ni - KT Nho', true );?></td>
                                </tr>
                            </tbody>
                        </table>    
                 <?php } ?>       
           </div>
           <?php }else{?>
		      <div class="price-product-sofa"><?php echo get_post_meta( get_the_ID(), 'Gia tien', true );?>VNĐ</div>
		      <div class="code-product-sofa"><?php echo get_post_meta( get_the_ID(), 'Ma san pham', true );?></div>
            <?php }?>
	    </header><!-- .entry-header -->	
        <div class="short-description">
            <?php the_excerpt();?>
        </div>
        
        <a class="button-buy add-to-cart" href="#">Đặt hàng ngay</a> 
        <a href="tel:0948565555" class="btn_buy_mobile" style="display: none;">Mua ngay</a>       
    </div>
	<div class="entry-content">
		<?php the_content(); ?>
        
        <div style="margin: 20px 0px; clear: both;">
            <?php if($cats[0]->slug == 'blog'){?>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=228708217165255";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    
                    <div class="fb-comments" data-href="<?php the_permalink();?>" data-width="100%" data-numposts="10"></div>
            <?php }?>
        </div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
