<!DOCTYPE html>
<html>
<head>
	<title></title>

	{{--Bootstrap css--}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	{{--jquery--}}
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
	  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	  crossorigin="anonymous"></script>
	{{--popper--}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	{{--bootstrap js--}}
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

	<div class="container">
		@if(Session::has("addBlog"))
		<div class="alert alert-success mt-5">
			{{ Session::get('addBlog') }}	
		</div>
		@elseif(Session::has("deleteBlog"))
		<div class="alert alert-success mt-5">
			{{ Session::get('deleteBlog') }}	
		</div>
		@elseif(Session::has("editBlog"))
		<div class="alert alert-success mt-5">
			{{ Session::get('editBlog') }}	
		</div>
		@endif

		<div class="row pt-5">
			<div class="col-lg-2">
				<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#createBlog">
				  Create New Blog
				</button>
				
				{{-- Hello, {{ Auth::user()->username }} --}}
				
			</div>
			<div class="col-lg-10">
				{{-- blog card --}}
				@foreach($blogs as $blog)
					<div class="card mb-5">
					  <div class="card-body">
					  	<div class="row">
					  		<div class="col-lg-8"><h5 class="card-title">{{$blog->title}}</h5></div>
					  		<div class="col-lg-4">
					  			<span><a href="" class="text-warning" data-toggle="modal" data-target="#editBlog{{$blog->id}}">
					  			Edit Blog</a></span> | 
					  			<span><a href="" class="text-danger" data-toggle="modal" data-target="#deleteBlog{{$blog->id}}">Delete Blog</a></span>
					  		</div>
					  	</div>
					    
					    @foreach($users as $user)
					    	<h6 class="card-subtitle mb-2 text-muted"><small>By: {{$user->username}}</small> {{$blog->updated_at->diffForHUmans()}}</h6>
					    @endforeach
					    <p class="card-text text-indent-left">{{$blog->content}}</p>
					    <a data-toggle="collapse" href="#collapseExample{{$blog->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" class="card-link">Show Comments</a>
					  </div>
					  	<div class="collapse" id="collapseExample{{$blog->id}}">
						  <div class="card-footer">
						    Comments Section
						  </div>
						</div>
					</div>


					{{-- delete blog modal--}}
					<div id="deleteBlog{{$blog->id}}" class="modal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Delete Blog</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Are you sure you want to delete blog <br>"<strong>{{$blog->title}}</strong>"?</p>
								</div>
								<div class="modal-footer">
									<form method="POST" action="/menu/{{$blog->id}}/delete">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger">I'm sure</button>			      		
									</form>
								</div>
							</div>
						</div>
					</div>

					{{-- edit blog modal --}}
					<div class="modal fade" id="editBlog{{$blog->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title">Edit your blog</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <form method="POST" action="/menu/{{$blog->id}}/edit" enctype="multipart/form-data">
					      <div class="modal-body">
					        	{{csrf_field()}}
					        	{{method_field('PATCH')}}
								<div class="form-group">
									<label>Title</label>
									<input type="text" name="title" id="title" class="form-control" value="{{$blog->title}}">
								</div>

								<div class="form-group">
									<label>Content</label>
									<textarea type="text" name="content" id="content" class="form-control">{{$blog->content}}</textarea>
								</div>        
					      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-dark">Save Changes</button>
						      </div>
					      </form>
					    </div>
					  </div>
					</div>
				@endforeach
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>
	

	{{-- create blog modal --}}
	<div class="modal fade" id="createBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">What's on your mind?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="POST" action="/addblog" enctype="multipart/form-data">
	      <div class="modal-body">
	        	{{ csrf_field() }}
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="title" id="title" class="form-control">
				</div>

				<div class="form-group">
					<label>Content</label>
					<textarea type="text" name="content" id="content" class="form-control"></textarea>
				</div>        
	      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-dark">Save</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

</body>
</html>