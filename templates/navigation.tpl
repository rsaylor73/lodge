<div class="col-md-4">

<div id='cssmenu'>
<ul>
   <li><a href="dashboard"><span>Dashboard</span></a></li>

	{if ($access eq "admin" or $access eq "agent" or $access eq "accounting")}
   <li class='active has-sub'><a href='#'><span>Reservations</span></a>
      <ul>

			{if ($access eq "admin" or $access eq "agent")}
         <li><a href='#'><span>New Reservation</span></a></li>
			{/if}
			<li><a href='#'><span>Locate Reservation</span></a></li>
		</ul>
	</li>
	{/if}

   {if ($access eq "admin" or $access eq "agent" or $access eq "accounting")}
   <li class='active has-sub'><a href='#'><span>Customers</span></a>
      <ul>
			<li><a href="#"><span>Resellers</span></a></li>
			<li><a href="#"><span>Contacts</span></a></li>
		</ul>
	</li>
	{/if}

	{if $access eq "admin"}
   <li class='active has-sub'><a href='#'><span>Administration</span></a>
      <ul>

         <li class='has-sub'><a href='#'><span>Locations</span></a>
            <ul>
               <li><a href='#'><span>Manage Lodge</span></a></li>
               <li><a href='#'><span>Add Lodge</span></a></li>
               <li class='last'><a href='#'><span>Lodge Settings</span></a></li>
            </ul>
         </li>

         <li class='has-sub'><a href='#'><span>Inventory</span></a>
            <ul>
               <li><a href='#'><span>Manage Inventory</span></a></li>
            </ul>
         </li>

         <li class='has-sub'><a href='#'><span>Users</span></a>
            <ul>
               <li><a href='users'><span>Manage Users</span></a></li>
            </ul>
         </li>


      </ul>
   </li>
	{/if}

   <li class='active has-sub'><a href='#'><span>Reports</span></a>
      <ul>
	      {if ($access eq "admin" or $access eq "accounting")}

         <li class='has-sub'><a href='#'><span>Financial</span></a>
            <ul>
               <li><a href='#'><span>Transfer Report</span></a>
               <li><a href='#'><span>Balance Report</span></a>
               <li><a href='#'><span>Reconsile Report</span></a>

            </ul>
         </li>
			{/if}

         <li class='has-sub'><a href='#'><span>Guests</span></a>
            <ul>
               <li><a href='#'><span>Check-In Report</span></a>
               <li><a href='#'><span>Check-Out Report</span></a>
            </ul>
         </li>
      </ul>
   </li>



   <li class='last'><a href="logout"><span>Logout</span></a></li>
</ul>
</div>
</div>

