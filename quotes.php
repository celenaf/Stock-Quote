<?php
	ob_start();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false); 
	header("Pragma: no-cache");
?>

<!DOCTYPE html>

<html>

	<head>
		<title>Daily Quote</title>
		<link rel="stylesheet" type="text/css" href="main1.css" />
	</head>

	<body>
		<?php 
		include("header1.php");
		error_reporting(0);
		?>
		
		</br>
	
		<center>
		<div>
			<form name="symbol" action="quotes.php" method="get">
				<h3>Enter a symbol:</h3><input type="text" name ="symbolname" value="<?php echo $_REQUEST['symbolname']; ?>">
				<input type="submit" class="button1" value="Get Quote" onClick="symbol.action='quotes.php' ;" />
				<input type="submit" class="button2" value="Get History" onClick="symbol.action='history.php' ;" />
			</form>
		</div>
		</center>		
		
		<br>
	
	<center>
	<table>
	<?php 			
			$symbolname=$_REQUEST['symbolname'];
			
			if(! empty($symbolname))
			{
				$host = "cs.spu.edu";
				$user = "quotesdb";
				$pwd = "quotesdb";
			}
			
			$db = @new mysqli($host, $user, $pwd, 'quotesdb');
			
			if($db->connect_errno)   
				die(); 
			
			$query = "SELECT symSymbol, symName FROM symbols " . "WHERE symSymbol = '" . $symbolname ."'";
			
			$result=@$db->query($query);
			
			if(! $result)
			{   
				print "Invalid query result<br />\n";  
			}  
			
			else  
			{   
				// Process row   
				$row = @$result->fetch_assoc();

				print "<tr>";
				print "<td><b>Company Name:</b> {$row['symName']}</td>"; 				
				print "</tr>";
				
				print "<tr>";
				print "<td><b><div style='text-align: left'>Symbol is: <span style='color: blue'>{$row['symSymbol']}</span></div></b></td>";
				print "</tr>";
				$result->free();
			}
		
	?>
	</table>
	
	
	<table>
	<?php
			$query1 ="SELECT qSymbol, qQuoteDateTime FROM quotes" . " WHERE qSymbol='{$symbolname}'"    ." order by qQuoteDateTime desc";
			
			$result1=@$db->query($query1);
			
			if(! $result1)
			{   
				print "Invalid query result<br />\n";  
			}  
			
			else  
			{
				$row1 = @$result1->fetch_assoc();
				
				print "<tr>";
				print "<td><b>{$row1['qQuoteDateTime']}</font></b></td>";
				print "</tr>";
				
				$result->free();
			}
	?>
	</table>
	
	<table>
	<?php
	
			$query = "SELECT qSymbol, qQuoteDateTime, qLastSalePrice, qPreviousClosePrice, qNetChangePrice, qAskPrice, qNetChangePct, qBidPrice, qTodaysHigh, q52WeekHigh, qTodaysLow, q52WeekLow, qShareVolumeQty, qEarningsPerShare, qTotalOutstandingSharesQty, qCashDividendAmount, qCurrentYieldPct, qCurrentPERatio FROM quotes" . " WHERE qSymbol='{$symbolname}'"    ." order by qQuoteDateTime desc";
			
			$query1 = "SELECT symMarketCap FROM symbols";
			
			$result=@$db->query($query);
			$result1=@$db->query($query1);
			
			if((! $result) && (! $result1)) 
			{   
				print "Invalid query result<br />\n";  
			}  
			
			else  
			{   
				// Process row  
				$row = @$result->fetch_assoc();
				$row1 = @$result1->fetch_assoc();
				
				print "<tr>";
				print "<td>Last:</td>";
				print "<td> {$row['qLastSalePrice']}</td>"; 
				print "<td>Prev Close: </td>";
				print "<td> {$row['qPreviousClosePrice']}</td>"; 
				print "</tr>";
				
				print "<tr>";
				print "<td>Net Change Price: </td>";
				print "<td> {$row['qNetChangePrice']}</td>"; 
				print "<td>Ask Price: </td>";
				print "<td> {$row['qAskPrice']}</td>"; 
				print "</tr>";
				
				print "<tr>";
				print "<td>Net Change %: </td>";
				print "<td>{$row['qNetChangePct']}</td>"; 
				print "<td>Bid Price: </td>";
				print "<td>{$row['qBidPrice']}</td>"; 
				print "</tr>";
				
				print "<tr>";
				print "<td>Today's High: </td>";
				print "<td>{$row['qTodaysHigh']}</td>"; 
				print "<td>52 Week High: </td>";
				print "<td>{$row['q52WeekHigh']}</td>"; 
				print "</tr>";
				
				print "<tr>";
				print "<td>Today's Low: </td>";
				print "<td>{$row['qTodaysLow']}</td>"; 
				print "<td>52 Week Low: </td>";
				print "<td>{$row['q52WeekLow']}</td>"; 
				print "</tr>";
				
				$volume = $row['qShareVolumeQty'];
				$formatedVol = number_format($volume);
				
				print "<tr>";
				print "<td>Volume Qty: </td>";
				print "<td>$formatedVol</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "</tr>";
				
				print "<tr>";
				print "<td><b>Fundamentals: </b></td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "</tr>";
				
				$numShares = $row['qTotalOutstandingSharesQty'];
				$formatedNumShares = number_format($numShares);
				
				print "<tr>";
				print "<td>Earnings/share: </td>";
				print "<td>{$row['qEarningsPerShare']}</td>";
				print "<td># Shrs Out: </td>";
				print "<td>$formatedNumShares</td>";
				print "</tr>";
				
				print "<tr>";
				print "<td>Div/Share: </td>";
				print "<td>{$row['qCashDividendAmount']}</td>";
				print "<td>Div. Yield %: </td>";
				print "<td>{$row['qCurrentYieldPct']}</td>";
				print "</tr>";
							
				print "<tr>";
				print "<td>PE Ratio: </td>";
				print "<td>{$row['qCurrentPERatio']}</td>";
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "</tr>";
				
				$result->free();
				
			}  

	?>	
	</table>
	
	<table>
	<?php			
			$query1 = "SELECT symSymbol, symMarketCap FROM symbols " . "WHERE symSymbol = '" . $symbolname ."'";
			
			$result1=@$db->query($query1);
			
			if(! $result1)
			{   
				print "Invalid query result<br />\n";  
			}  
			
			else  
			{   
				// Process row  
				$row1 = @$result1->fetch_assoc();
				
				$marketCap = $row1['symMarketCap'];	
				$marketCap = number_format($marketCap);
							
				$marketCap = $row1['symMarketCap'];	
				$formatedMarketCap = number_format($marketCap);
				
				print "<tr>";
				print "<td>Market Cap.</td>";
				print "<td>$formatedMarketCap </td>";
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "<td>&nbsp;</td>"; 
				print "</tr>";
				
				$result->free();
			}  
	?>	
	</table>
	</center>
	
	<br>
	
	<?php 
	@$result->data_seek(0); 
	@$db->close(); 
	
	include("footer.php");
	ob_end_flush()?>
	
	</body>
	
</html>