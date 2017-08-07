<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<rss version="2.0">
  <channel>
  
        <?php if(!empty($list)){?>
        <?php foreach($list as $item){?>
        <item>
			<title>
				<![CDATA[<?php echo $item->title;?>]]>
			</title>
			<link><?php echo site_url($type_link['link'].'/view/'.$item->id);?></link>
			<author>优享</author>
			<guid><?php echo site_url($type_link['link'].'/view/'.$item->id);?></guid>
			<category>
				<![CDATA[]]>
			</category>
			<pubDate><?php echo dateTime($item->add_time);?></pubDate>
			<comments></comments>
			<description>
				<![CDATA[<?php echo $item->content;?>]]>
			</description>
		</item>
        <?php }?>
        <?php }?>

	</channel>
</rss>