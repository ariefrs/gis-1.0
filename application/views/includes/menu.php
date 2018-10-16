<?php
			// data main menu
			$module = $this->session->userdata('module_id');
			$this->db->where('module_id', $module);
			$this->db->where('is_main_menu', 0);
			$this->db->where('judul_menu !=', 'Main Menu');
			$this->db->order_by('order','ASC');
			$main_menu = $this->db->get('menu');
			foreach ($main_menu->result() as $main) 
			{
				// Query untuk mencari data sub menu
				$sub_menu = $this->db->order_by('order','ASC')->get_where('menu', array('is_main_menu' => $main->id));
				// periksa apakah ada sub menu
				if ($sub_menu->num_rows() > 0) 
				{
					// main menu dengan sub menu
					echo "<li class='treeview'>" . anchor($main->link, '<i class="' . $main->icon . '"></i><span>' . $main->judul_menu.
							'</span><span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>');
					// sub menu nya disini
					echo "<ul class='treeview-menu'>";
					foreach ($sub_menu->result() as $sub) 
					{
						$sub_menu2 = $this->db->order_by('order','ASC')->get_where('menu', array('is_main_menu' => $sub->id));
						// periksa apakah ada sub menu
						if ($sub_menu2->num_rows() > 0 )
						{
						echo "<li  class='treeview'>" . anchor($sub->link, '<i class="' . $sub->icon . '"></i>' . $sub->judul_menu.
							'</span><span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>');
							// sub menu nya disini
							echo "<ul class='treeview-menu'>";
							foreach ($sub_menu2->result() as $sub2) 
							{
								echo "<li  class='treeview'>" . anchor($sub2->link, '<i class="' . $sub2->icon . '"></i>' . $sub2->judul_menu)."</li>";

							}
							echo "</ul></li>";
						}else{
							echo "<li  class='treeview'>" . anchor($sub->link, '<i class="' . $sub->icon . '"></i>' . $sub->judul_menu)."</li>";
						}
					}
					echo "</ul></li>";
				}else{
				// main menu tanpa sub menu
				echo "<li class='treeview'>" . anchor($main->link, '<i class="' . $main->icon . '"></i><span>' . $main->judul_menu) . "</span></li>";
				}
			}
			?>