<?php $this->load->view('structure/header/designer.php') ?>

<div id="centerbox">
	<form id="primaryform" action="<?=site_url('designer/delivery') ?>" method="post">
        <div id="designer" class="basket">
        
        	<div class="basketbox">
            	<h1 class="title">My Basket</h1>
                
                <div class="basketitems">
                	<!-- Start Basket Loop -->
<?php foreach($products as $basket_index=>$product): ?>
                	<div class="basketproduct">
                        <div class="basketproductimg">
                        	<img src="<?=site_url('ajax/basket_image/' . $basket_index . '?' . SID) ?>" alt="" />
                        </div>
                        <div class="basketproductdetail">
                        	<div class="basketproductdetailtop">
                            	<div>
                                	Reference Number<br />
                                    <span><?=str_pad($product->id, 14, 'MYBIFOLD/00000', STR_PAD_LEFT) ?></span>
                                </div>
                            	<div>
                                	 Colour<br />
                                    <span><?=$product->external_colour->name ?></span>
                                </div>
                            	<div>
                                	Configuration<br />
                                    <span><?=$product->bifold_scheme->name ?></span>
                                </div>
                            </div>
                            <div class="basketproductdetailremove">
                            	<a href="<?=site_url('designer/basket_delete/' . $basket_index) ?>">remove</a>
                            </div>
                            <div class="basketproductprice">
                            	<?php if(strtoupper($product->voucher_code) == 'MYB10'): ?><i style="font-size: 14px;line-height:15px;vertical-align: middle;">Special 10% discount! </i><?php endif ?><span>Price &pound;<?=number_format($product->get_total(), 2)?></span>
                                <a data-toggle="modal" href="<?=site_url('ajax/basket_summary/' . $basket_index) ?>" data-target=".help-modal-basketdetail-<?=$basket_index?>" class="helpbox">view details</a>
                            </div>
                        </div>
                    </div>
<?php endforeach ?>
                	<!-- End Basket Loop -->
                </div>
                
                <div class="designanother">
                    <a href="<?=site_url('designer/create') ?>">design another</a>
                </div>
            </div>
            
            <div class="footer">
                <div class="footerleft">
                	<img src="<?=base_url('assets/images/footer-logo.png') ?>" alt="" />
                </div>
                <div class="footerright">
<?php if($this->session->cart->get_count() > 0): ?>
<?php $this->load->view('designer/block/cart', array('cart'=>$this->session->cart)) ?>
<?php endif ?>
                    <div id="submit" class="nextbtn">
                    	<span class="span1">Email My Quote<?=($this->session->cart->get_count() > 1) ? 's' : '' ?> </span>
                    	<span class="span2">click here</span>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>



<?php foreach($products as $basket_index=>$product): ?>
<div class="modal fade help-modal-basketdetail-<?=$basket_index ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    </div>
  </div>
</div>
<?php endforeach ?>

<?php $this->load->view('structure/footer/designer.php') ?>