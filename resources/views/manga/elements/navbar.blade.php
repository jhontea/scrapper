                            <nav id="nav">
								<ul>
									<li @if(request()->route()->getName() == 'manga.index') class="current" @endif><a href="{{ asset('/crawler/manga') }}">Home</a></li>
									<li @if(request()->route()->getName() == 'manga.add') class="current" @endif><a href="{{ asset('/crawler/manga/add-manga') }}">Add Manga</a></li>
									<li @if(request()->route()->getName() == 'manga.my') class="current" @endif><a href="{{ asset('/crawler/manga/my-manga') }}">My Manga</a></li>
									<!-- <li>
										<a href="#">Dropdown</a>
										<ul>
											<li><a href="#">Lorem ipsum dolor</a></li>
											<li><a href="#">Magna phasellus</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											<li>
												<a href="#">Phasellus consequat</a>
												<ul>
													<li><a href="#">Magna phasellus</a></li>
													<li><a href="#">Etiam dolore nisl</a></li>
													<li><a href="#">Veroeros feugiat</a></li>
													<li><a href="#">Nisl sed aliquam</a></li>
													<li><a href="#">Dolore adipiscing</a></li>
												</ul>
											</li>
											<li><a href="#">Veroeros feugiat</a></li>
										</ul>
									</li>
									<li><a href="left-sidebar.html">Left Sidebar</a></li>
									<li><a href="right-sidebar.html">Right Sidebar</a></li>
									<li><a href="no-sidebar.html">No Sidebar</a></li> -->
								</ul>
							</nav>