<?php 
function printMenu($currentTab){
	echo '<nav>
				<ul>
					<li>
						<a '; if($currentTab=='Home') echo ' class="current"'; echo ' href="/3TierLabrefactored/index.php">Home</a>
					</li>
					<li>
						<a '; if($currentTab=='Register') echo ' class="current"'; echo ' href="/3TierLabrefactored/scripts/ViewFiles/register_html.php">Register</a>
					</li>
					<li>
						<a  href="mailto:akhilesh-bajaj@utulsa.edu">Email Us</a>
					</li>
				</ul>
			</nav>
	
	';
	
	
}//printMenu()








?>