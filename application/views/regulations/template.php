		<div style="display: none">
			<table>
				<tbody id="template">
					<tr id="row">
						<td class="form-group">
							<textarea class="form-control" id="<?php echo $abrv;?>terms_content" name="<?php echo $abrv;?>terms_content[]"></textarea>
						</td>
						<td class="form-group">
							<input type="text" placeholder="" class="form-control" id="<?php echo $abrv;?>terms_numbering" name="<?php echo $abrv;?>terms_numbering[]" aria-required="true"  />
						</td>
						<td>
							<input type="number" placeholder="排序號碼" class="form-control" id="<?php echo $abrv;?>terms_sort" name="<?php echo $abrv;?>terms_sort[]" aria-required="true" value="0" />
						</td>
						<td width="10%">
							<a id="delRow" class="btn red delete">
	                            <i class="fa fa-trash"></i>
	                            <span> 刪除 </span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>