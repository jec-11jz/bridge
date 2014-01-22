<?php
	$this->Html->css('toppage.css', null, array('inline' => false));
	$this->Html->css('3d/style.css', null, array('inline' => false));
	$this->Html->css('3d/demo.css', null, array('inline' => false));
	
	
	echo $this->Html->script('3d/jquery.transit.min');
	echo $this->Html->script('3d/jquery.imagesloaded');
	echo $this->Html->script('3d/jquery.ba-dotimeout.min');
	echo $this->Html->script('3d/jquery.gridgallery');
	echo $this->Html->script('3d/modernizr.custom.69142');
	
	
	$this->extend('/Common/index');
?>
<script>	
	$(function() {
		$( '#sg-panel-container' ).gridgallery();
	});
</script>
	
<div id="gallery">	
	<ul id="sg-panel-container">
			<li data-w="60" data-h="55">
				<img title="Grexit" src="../../img/3d/1.jpg" data-rotate-x="50" />
				<img title="Godwottery" src="../../img/3d/2.jpg" data-rotate-y="-50" />
				<img title="Somniloquent" src="../../img/3d/3.jpg" data-rotate-x="50" data-translate-z="-700" />
				<div data-translate-z="-500" >
					<div class="sg-content">
						<h3>Responsive 3D Panel Layout</h3>
						<p>Best viewed in WebKit browsers</p>
					</div>
				</div>
			</li>
			<li data-w="100" data-h="40">
				<img title="Grexit" src="../../img/3d/5.jpg" data-rotate-x="50" />
				<img title="Godwottery" src="../../img/3d/6.jpg" data-rotate-y="-50" />
			</li>
			<li data-w="35" data-h="65">
				<img title="Etiquette" src="../../img/3d/1.jpg" data-translate-x="-300"/>
				<img title="Somniloquent" src="../../img/3d/4.jpg" data-translate-y="300"/>
				<img title="Godwottery" src="../../img/3d/8.jpg" data-translate-y="300"/>
				<img title="Grexit" src="../../img/3d/3.jpg" data-translate-x="300"/>
			</li>
			<li data-w="60" data-h="55">
				<img title="Grexit" src="../../img/3d/8.jpg" data-rotate-x="50" />
				<img title="Godwottery" src="../../img/3d/4.jpg" data-rotate-y="-50" />
				<div>
					<div class="sg-content">
						<h3>Proinde vos postulo</h3>
						<p>Veggies sunt bona vobis, proinde vos postulo esse magis amaranth gram radish garlic parsley napa cabbage.</p>
					</div>
				</div>
				<img title="Somniloquent" src="../../img/3d/3.jpg" data-rotate-x="50" data-translate-z="-700" />
			</li>
			<li data-w="40" data-h="100">
				<img title="Grexit" src="../../img/3d/1.jpg" data-rotate-x="50" />
				<img title="Godwottery" src="../../img/3d/2.jpg" data-rotate-x="50" data-translate-z="-700" />
			</li>
			<li data-w="30" data-h="100">
				<img title="Grexit" src="../../img/3d/7.jpg" data-rotate-x="50" />
				<div data-rotate-y="50">
					<div class="sg-content">
						<h3>Beet greens tigernut</h3>
						<p>Beet greens tigernut prairie turnip broccoli rabe cabbage tomato sea lettuce garlic chicory earthnut pea pea celery summer purslane bell pepper amaranth kale. Bok choy broccoli arugula turnip greens seakale welsh onion okra cauliflower artichoke coriander. Courgette bok choy salad soybean salsify pea sprouts sorrel pea.</p>
						<p>Lettuce tomato celery lotus root water chestnut salad silver beet beet greens coriander salsify pea sprouts corn. Dulse endive lentil asparagus dulse groundnut prairie turnip wakame bush tomato cauliflower salsify sierra leone bologi melon azuki bean beetroot. Squash scallion dulse bok choy spinach cress parsley winter purslane garlic kakadu plum gumbo watercress jícama mung bean carrot eggplant. Tomato beet greens celtuce tomatillo chickweed welsh onion peanut dandelion pea sprouts avocado potato okra salsify komatsuna turnip greens. Gourd swiss chard sea lettuce sorrel pumpkin chickweed fava bean tomato daikon taro.</p>
						<p>Broccoli rabe gumbo lentil spring onion gourd mustard dulse tomatillo pea sprouts wakame daikon squash courgette komatsuna soybean melon arugula napa cabbage. Squash taro soybean bunya nuts gourd garlic arugula beet greens leek nori celtuce okra maize kohlrabi mustard. Fennel pumpkin grape courgette bitterleaf cabbage silver beet lotus root shallot eggplant.</p>
						<p>Chard spinach dulse celery green bean bunya nuts broccoli tomatillo tomato watercress broccoli rabe. Corn summer purslane garlic lettuce brussels sprout chickweed bell pepper bamboo shoot maize winter purslane broccoli rabe coriander daikon chickpea cucumber. Napa cabbage radicchio bamboo shoot tomatillo asparagus bush tomato avocado coriander kale turnip greens nori catsear. Cress wattle seed broccoli rabe mung bean groundnut radicchio dulse kombu azuki bean spring onion. Yarrow dandelion rutabaga bok choy broccoli bell pepper artichoke caulie pea sprouts bitterleaf beetroot tigernut desert raisin kohlrabi sweet pepper turnip greens avocado.</p>
						<p>Gumbo water chestnut maize ricebean spring onion wakame black-eyed pea squash cress celery. Ricebean zucchini spinach beetroot black-eyed pea kakadu plum artichoke broccoli dulse burdock pumpkin onion kale caulie amaranth. Garbanzo squash parsley taro shallot bamboo shoot salad bush tomato kohlrabi napa cabbage black-eyed pea broccoli rabe burdock.</p>
					</div>
				</div>
			</li>
			<li data-w="100" data-h="100">
				<img title="Grexit" src="../../img/3d/3.jpg" data-rotate-y="50" data-translate-z="-1700" />
			</li>
			<li data-w="50" data-h="50">
				<img title="Grexit" src="../../img/3d/1.jpg" data-translate-z="250" />
				<img title="Godwottery" src="../../img/3d/2.jpg" data-translate-z="250" />
				<img title="Somniloquent" src="../../img/3d/3.jpg" data-translate-z="250" />
				<img title="Etiquette" src="../../img/3d/4.jpg" data-translate-z="250" />
			</li>
			<li data-w="100" data-h="40">
				<div>
					<div class="sg-content sg-columns">
						<h3>Parsley sorrel dulse</h3>
						<p>Parsley sorrel dulse seakale turnip greens summer purslane. Celery celery rock melon quandong collard greens gourd gram turnip fennel mung bean courgette lotus root azuki bean. </p>
						<p>Turnip greens arugula garlic shallot grape tomato tomatillo celtuce gumbo water chestnut lettuce groundnut dandelion horseradish pea turnip greens gourd burdock. Horseradish rock melon scallion bamboo shoot earthnut pea fennel parsley garlic summer purslane onion nori pea caulie ricebean mustard leek. Leek fennel cucumber green bean gourd desert raisin rock melon maize turnip greens beet greens caulie celtuce welsh onion parsnip kohlrabi dulse grape. Caulie spinach bitterleaf wakame parsley salad pea. Bush tomato lettuce chickpea horseradish kombu parsley sorrel grape okra celery daikon chicory beetroot plantain welsh onion mustard radicchio yarrow.</p>
						<p>Okra catsear scallion cabbage salad garbanzo. Pea sprouts kombu scallion grape dulse endive bamboo shoot bell pepper komatsuna okra jícama collard greens. Ricebean cress peanut onion bush tomato gourd scallion artichoke zucchini squash corn.</p>
					</div>
				</div>
				<img title="Godwottery" src="../../img/3d/5.jpg" data-rotate-y="-50" />
			</li>
			<li data-w="100" data-h="100">
				<img title="Grexit" src="../../img/3d/1.jpg" data-rotate-z="20" data-translate-z="700" />
			</li>
			<li data-w="50" data-h="50">
				<img title="Grexit" src="../../img/3d/6.jpg" data-rotate-y="90" data-translate-z="-700" />
				<div data-rotate-y="50">
					<div class="sg-content">
						<h3>Chicory corn cauliflower</h3>
						<p>Yarrow radicchio wattle seed peanut chicory corn cauliflower kakadu plum kale grape. Celtuce prairie turnip burdock rutabaga bok choy cress swiss chard peanut bitterleaf caulie seakale bush tomato. </p>
					</div>
				</div>
				<div data-rotate-y="50">
					<div class="sg-content">
						<h3>Chard turnip greens</h3>
						<p>Salsify spinach endive parsley lentil jícama avocado rock melon azuki bean melon kale onion grape welsh onion plantain yarrow. Peanut pea sprouts watercress celtuce maize chard turnip greens spinach seakale cabbage pumpkin.</p>
						</div>
					</div>
				<img title="Somniloquent" src="../../img/3d/3.jpg" data-rotate-y="-90" data-translate-z="-700" />
			</li>
		</ul>
</div>
