						<?php
						$alerts = json_decode($this->session->flashdata('alerts'), true);
						if( isset($alerts) ){
							foreach( $alerts as $k => $val ){
								switch( $k ){
									case 'success':
										$result = '<i class="fa fa-check"></i>';
									break;
									case 'warning':
										$result = '<i class="fa fa-warning"></i>';
									break;
									case 'info':
										$result = '<i class="fa fa-info"></i>';
									break;
									default:
										$result = '<i class="fa fa-times"></i>';
									break;
								}
						?>
						<div class="alert alert-<?php echo $k;?> alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<strong><?php echo $result;?></strong> <?php echo $val;?>
						</div>
						<?php
							}
						}
						?>
