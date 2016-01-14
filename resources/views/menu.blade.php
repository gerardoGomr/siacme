<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">
	<div id="sidebar-fusion-wrapper">
		<div id="brandWrapper">
			<a href="index.html?lang=en" class="display-block-inline pull-left logo"><img src="assets/images/logo/app-logo-style-default.png" alt=""></a>
			<a href="index.html?lang=en"><span class="text">SIACME</span></a>
		</div>
		<div id="logoWrapper">
			<div id="logo">
				<a href="{{ url('/') }}" class="btn btn-sm btn-inverse"><i class="fa fa-fw icon-home-fill-1"></i></a>
			</div>
		</div>

		<!-- SIDEBAR MENU -->
		<ul class="menu list-unstyled" id="navigation_current_page">
			<li class="hasSubmenu">
				<a href="#ulJohanna" data-toggle="collapse" class="glyphicons girl"><i></i><span>Dra. Johanna Vázquez</span></a>
				<ul class="collapse" id="ulJohanna">
					<li><a href="{{ url('/citas/johanna.vazquez/') }}" class="glyphicons calendar"><i></i><span> Citas</span></a></li>
					<li><a href="{{ url('/consultas/johanna.vazquez/') }}" class="glyphicons calendar"><i></i><span> Consultas</span></a></li>
				</ul>
			</li>
			<li>
			    <a href="/expedientes" class="glyphicons nameplate_alt"><i></i><span>Expedientes</span></a>
			</li>
		</ul>
	</div>
</div>