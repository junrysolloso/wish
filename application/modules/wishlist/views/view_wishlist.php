
<div id="container" style="margin: 2% 30%">

	<?php if( validation_errors() ): ?>
		<div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
			<?php echo validation_errors(); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif; ?>

	<?php if( $this->session->tempdata('msg') ): ?>
		<div class="alert <?php echo $this->session->tempdata('class'); ?> alert-dismissible fade show rounded-0 alert-temp" role="alert">
			<?php echo $this->session->tempdata('msg'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif; ?>

	<div class="form-add">
		<div class="text-center">
			<h1 class="display-4 p-4">Welcome to wishlist note!</h1>
		</div>
		<div class="card rounded-0 shadow-sm p-5 bg-white">
			<div class="card-body">
				<form action="#" method="post">

					<div class="form-group">
						<label for="item_title" class="col-form-label-lg">Name</label>
						<input type="text" name="item_title" id="item_title" class="form-control rounded-0" />
					</div>

					<div class="form-group">
						<label for="item_price" class="col-form-label-lg">Price</label>
						<input type="number" name="item_price" id="item_price" class="form-control rounded-0" />
					</div>

					<div class="form-group">
						<label for="item_url" class="col-form-label-lg">URL</label>
						<input type="url" name="item_url" id="item_url" class="form-control rounded-0" />
					</div>

					<div class="form-group">
						<input type="submit" name="add" value="Add Wishlist" id="submit" class="btn btn-primary rounded-0" />
					</div>

				</form>
			</div>
		</div>
	</div>
	
	<?php if( ! empty( $item ) && $item ): ?>
		<?php foreach ( $item as $row ): ?>
		<div class="text-center">
			<h2 class="display-4 p-4">Update your wishlist.</h2>
		</div>
		<div class="card rounded-0 shadow-sm p-5 bg-white form-update">
			<div class="card-body">
				<form action="#" method="post">

					<div class="form-group">
						<label for="item_title" class="col-form-label-lg">Name</label>
						<input type="hidden" name="item_id" value="<?php echo $row->item_id; ?>" />
						<input type="text" name="item_title" value="<?php echo $row->item_title; ?>" id="item_title" class="form-control rounded-0" />
					</div>

					<div class="form-group">
						<label for="item_price" class="col-form-label-lg">Price</label>
						<input type="number" name="item_price" value="<?php echo  $row->item_price; ?>" id="item_price" class="form-control rounded-0" />
					</div>

					<div class="form-group">
						<label for="item_url" class="col-form-label-lg">URL</label>
						<input type="url" name="item_url" value="<?php echo $row->item_url; ?>" id="item_url" class="form-control rounded-0" />
					</div>

					<div class="form-group">
						<input type="submit" name="update" value="Update Wishlist" id="update" class="btn btn-primary rounded-0" />
					</div>

				</form>
			</div>
		</div>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if( ! empty( $items ) && $items ): ?>
		<div class="text-center">
			<h2 class="display-4 p-4">Hooray! Your wishlist.</h2>
		</div>
		<div class="card rounded-0 shadow-sm bg-white">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Price</th>
							<th scope="col">URL</th>
							<th scope="col text-left">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr></tr>
						<?php
							foreach ( $items as $row ) {
								echo '<tr>';
								echo '<td>'. $row->item_title .'</td>';
								echo '<td>'. number_format( $row->item_price, 2 ) .'</td>';
								echo '<td>'. $row->item_url .'</td>';
								echo '<td><a href="'. base_url() .'wishlist/?iu='. $row->item_id .'" class="text-left">Update</a>&nbsp;<a href="'. base_url() .'wishlist/?id='. $row->item_id .'" class="text-left">Delete</a></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php endif;?>

	<div class="text-center p-3">[ Page rendered in <strong>{elapsed_time}</strong> seconds ]</div>
</div>
