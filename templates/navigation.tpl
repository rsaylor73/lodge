<div class="col-md-4">

<div id='cssmenu'>
<ul>
   <li><a href="dashboard"><span>Dashboard</span></a></li>

	{if ($access eq "admin" or $access eq "agent" or $access eq "accounting")}
   <li class='active has-sub'><a href='#'><span>Reservations</span></a>
      <ul>

			{if ($access eq "admin" or $access eq "agent")}
         <li><a href='newreservation'><span>New Reservation</span></a></li>
			{/if}
			<li><a href='locatereservation'><span>Locate Reservation</span></a></li>
		</ul>
	</li>
	{/if}

   {if ($access eq "admin" or $access eq "agent" or $access eq "accounting")}
   <li class='active has-sub'><a href='#'><span>Customers</span></a>
      <ul>
			<li><a href="resellers"><span>Resellers</span></a></li>
			<li><a href="contacts"><span>Contacts</span></a></li>
		</ul>
	</li>
	{/if}


   <li class='active has-sub'><a href='#'><span>Reports</span></a>
      <ul>
         {if ($access eq "admin" or $access eq "accounting")}

         <li class='has-sub'><a href='#'><span>Financial</span></a>
            <ul>
               <li><a href='transferreport'><span>Transfer Report</span></a>
               <li><a href='balancereport'><span>Balance Report</span></a>
               <li><a href='paymentreport'><span>Payment Report</span></a>

            </ul>
         </li>
         {/if}

         <li class='has-sub'><a href='#'><span>Guests</span></a>
            <ul>
               <li><a href='checkinreport'><span>Check-In Report</span></a>
               <li><a href='checkoutreport'><span>Check-Out Report</span></a>
            </ul>
         </li>
      </ul>
   </li>


	{if $access eq "admin"}
   <li class='active has-sub'><a href='#'><span>Administration</span></a>
      <ul>

         <li><a href='lodge'><span>Manage Lodge</span></a></li>
         <li><a href='line_items'><span>Line Items</span></a></li>
         <li><a href='discounts'><span>Discounts</span></a></li>
         <li><a href='users'><span>Users</span></a></li>
         <li><a href='permissions'><span>Permissions</span></a></li>


      </ul>
   </li>
	{/if}



   <li class='last'><a href="logout"><span>Logout</span></a></li>
</ul>
</div>
</div>

