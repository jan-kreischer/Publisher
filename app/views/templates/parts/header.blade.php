<header>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-inner">	
			<div class="container">
				<div class="navbar-header">		
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<!-- <span class="sr-only">Toggle navigation</span>-->
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="/" class="navbar-brand">
						<img alt="Brand" src="/includes/img/publisr.svg" id="logo" class="svg">
						Publisr				
					</a><!-- END .navbar-brand -->
				</div><!-- END .navbar-header -->
				
				<!-- Area made to collapse -->
				<div class="navbar-collapse collapse">
					<div class="navbar-left">
						{{ 
							Form::open([
							    'route' => 'search',
							    'method' => 'GET',
							    'id' => 'search_form',
							    'class' => 'navbar-form',
							    'accept-charset' => 'UTF-8',
							    'name' => 'search',
							]);
						}}
								<input name="q" type="text" class="form-control" placeholder="Search"/>
								<button type="submit" class="btn btn-default">
									<i class="fa fa-search"></i>
								</button>
						</form><!-- END .navbar-form -->
					</div><!-- END .navbar-left -->
					
					<div class="navbar-right">
						<ul class="nav navbar-nav">
							@if(!Auth::check())
							<li>
							
								<a href="/login" title="login">
									<i class="fa fa-sign-in"></i>
									Sign-In
								</a>
							</li>
	
							<li>
								<a href="/register" title="register">Sign-Up</a>
							</li>
							@endif
							
							<li class="dropdown">						
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									@if(Auth::check())
										<i class="fa fa-user"></i>
										My Account
									@endif
									<i class="fa fa-caret-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li>{{HTML::link('/articles', 'Articles', [])}}</li>
									<li>{{HTML::link('/authors', 'Authors', [])}}</li>
									@if(Auth::check())
									<li>{{HTML::link('/user', 'Profile', [])}}</li>
									<li>{{HTML::link('/logout', 'Logout', [])}}</li>	
									@endif		
								</ul>
							</li>
						</ul>
					</div><!-- END .navbar-right -->
				</div><!-- END .navbar-collapse -->
			</div><!-- END .container -->
		</div><!-- END .navbar-inner -->
		<div id="progress_bar">
	
		</div>
	</nav><!-- END .navbar -->
</header><!-- END .header -->
