<?php
class smseourl extends Module
{
	public function __construct()
	{
		$this->name = 'smseourl';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Kamruzzaman';
		$this->need_instance = 0;
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->l('SEO Friendly URL Module');
		$this->description = $this->l('SEO Friendly URL Module. If you want to make a Online E-Commerce Store Using Prestashop, WordPress, Opencart, Laravel, Django. Please email Us : kamrulbd36@gmail.com ');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}
	public function install()
	{
		if(!parent::install()
			|| !$this->registerHook(array('moduleRoutes','actionDispatcher','actionAdminMetaControllerUpdate_optionsAfter'))
			)
			return false;
		Configuration::updateValue('smseourl_ishtml',0);
		Configuration::updateValue('smseourl_product_slug',"product");
		Configuration::updateValue('smseourl_category_slug',"category");
		Configuration::updateValue('smseourl_manufacture_slug',"manufacturer");
		Configuration::updateValue('smseourl_supplier_slug',"supplier");
		Configuration::updateValue('smseourl_cms_slug',"content");
		Configuration::updateValue('smseourl_cms_category_slug',"content-category");
		$this->getRoutes();
		$this->setRoutes();
		return true;
	}
	public function uninstall()
	{
		Configuration::deleteByName('smseourl_ishtml');
		Configuration::deleteByName('smseourl_product_slug');
		Configuration::deleteByName('smseourl_category_slug');
		Configuration::deleteByName('smseourl_manufacture_slug');
		Configuration::deleteByName('smseourl_supplier_slug');
		Configuration::deleteByName('smseourl_cms_slug');
		Configuration::deleteByName('smseourl_cms_category_slug');
		$this->setDefaultRoutes();
		if(!parent::uninstall()
			|| !$this->unregisterHook('moduleRoutes')
			|| !$this->unregisterHook('actionDispatcher')
			|| !$this->unregisterHook('actionAdminMetaControllerUpdate_optionsAfter')
		)
			return false;
		return true;
	}
	public function disable($force_all = false)
	{
		$this->setDefaultRoutes();
		if(!parent::disable($force_all)
			)
			return false;
		return true;
	}
	public function enable($force_all = false)
	{
		if(!parent::enable($force_all)
			)
			return false;
		$this->setRoutes();
		return true;
	}
    public function getModuleRoutes()
    {
    	$is_html = (bool)Configuration::get('smseourl_ishtml');
    	$html = '.html';
    	if(!$is_html){
    		$html = '';
    	}
    	$smseourl_product_slug = Configuration::get('smseourl_product_slug');
    	if(empty($smseourl_product_slug)){
    		$smseourl_product_slug = "product";
    	}
    	$smseourl_category_slug = Configuration::get('smseourl_category_slug');
    	if(empty($smseourl_category_slug)){
    		$smseourl_category_slug = "category";
    	}
    	$smseourl_manufacture_slug = Configuration::get('smseourl_manufacture_slug');
    	if(empty($smseourl_manufacture_slug)){
    		$smseourl_manufacture_slug = "manufacturer";
    	}
    	$smseourl_supplier_slug = Configuration::get('smseourl_supplier_slug');
    	if(empty($smseourl_supplier_slug)){
    		$smseourl_supplier_slug = "supplier";
    	}
    	$smseourl_cms_slug = Configuration::get('smseourl_cms_slug');
    	if(empty($smseourl_cms_slug)){
    		$smseourl_cms_slug = "content";
    	}
    	$smseourl_cms_category_slug = Configuration::get('smseourl_cms_category_slug');
    	if(empty($smseourl_cms_category_slug)){
    		$smseourl_cms_category_slug = "content-category";
    	}
        $default_routes = array(
	        'category_rule' => array(
	            'controller' =>    'category',
	            'rule' =>        $smseourl_category_slug.'/{rewrite}'.$html,
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'category',
                ),
	        ),
	        'supplier_rule' => array(
	            'controller' =>    'supplier',
	            'rule' =>        $smseourl_supplier_slug.'/{rewrite}'.$html,
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'supplier',
                ),
	        ),
	        'manufacturer_rule' => array(
	            'controller' =>    'manufacturer',
	            'rule' =>        $smseourl_manufacture_slug.'/{rewrite}'.$html,
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'manufacturer',
                ),
	        ),
	        'cms_rule' => array(
	            'controller' =>    'cms',
	            'rule' =>        $smseourl_cms_slug.'/{rewrite}'.$html,
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'cms',
                ),
	        ),
	        'cms_category_rule' => array(
	            'controller' =>    'cms',
	            'rule' =>        $smseourl_cms_category_slug.'/{rewrite}'.$html,
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'cms',
                    'subcontroller' => 'cms_category',
                ),
	        ),
	        'product_rule' => array(
	            'controller' =>    'product',
	            'rule' =>        $smseourl_product_slug.'/{rewrite}'.$html,
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'id_product_attribute' => array('regexp' => '[0-9]+'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'ean13' =>        array('regexp' => '[0-9\pL]*'),
	                'category' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'categories' =>        array('regexp' => '[/_a-zA-Z0-9-\pL]*'),
	                'reference' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'manufacturer' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'supplier' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'price' =>            array('regexp' => '[0-9\.,]*'),
	                'tags' =>            array('regexp' => '[a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'product',
                ),
	        ),
	        'layered_rule' => array(
	            'controller' =>    'category',
	            'rule' =>        $smseourl_category_slug.'/{rewrite}{/:selected_filters}',
	            'keywords' => array(
	                'id' =>            array('regexp' => '[0-9]+'),
	                'selected_filters' =>    array('regexp' => '.*', 'param' => 'selected_filters'),
	                'rewrite' =>        array('regexp' => '[_a-zA-Z0-9\pL\pS-]*', 'param' => 'rewrite'),
	                'meta_keywords' =>    array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	                'meta_title' =>        array('regexp' => '[_a-zA-Z0-9-\pL]*'),
	            ),
                'params' => array(
                    'fc' => 'controller',
                    'controller' => 'category',
                    'subcontroller' => 'selected_filters',
                ),
	        ),
	    );
        return $default_routes;
    }
    public function hookmoduleRoutes($params)
    {
    	$routes = $this->getModuleRoutes();
    	return $routes;
    }
    public function hookactionAdminMetaControllerUpdate_optionsAfter($params)
    {
    	$this->setRoutes();
    }
    public function setRoutes()
    {
    	$routes = $this->getModuleRoutes();
    	if(isset($routes) && !empty($routes)){
    		foreach ($routes as $routeKey => $routeValue) {
    			if(isset($routeValue['rule']) && !empty($routeValue['rule'])){
    				Configuration::updateValue('PS_ROUTE_'.$routeKey,$routeValue['rule']);
    			}
    		}
    	}
    	// return true;
    }
    public function getRoutes()
    {
    	$routes = $this->getModuleRoutes();
    	if(isset($routes) && !empty($routes)){
    		foreach ($routes as $routeKey => $routeValue){
    			$defRoute = Configuration::get('PS_ROUTE_'.$routeKey);
    			if(isset($defRoute) && !empty($defRoute)){
    				Configuration::updateValue('sm_PS_ROUTE_'.$routeKey,$defRoute);
    			}
    		}
    	}
    	// return true;
    }
    public function setDefaultRoutes()
    {
    	$routes = $this->getModuleRoutes();
    	if(isset($routes) && !empty($routes)){
    		foreach ($routes as $routeKey => $routeValue){
    			$defRoute = Configuration::get('sm_PS_ROUTE_'.$routeKey);
    			if(isset($defRoute) && !empty($defRoute)){
    				Configuration::updateValue('PS_ROUTE_'.$routeKey,$defRoute);
    			}
    		}
    	}
    	// return true;
    }
    public function hookactionDispatcher($params)
    {
    	if((isset($this->context->controller->controller_type)) && ($this->context->controller->controller_type == 'front')){
    		$php_self = $this->context->controller->php_self;
    		if($php_self == 'category'){
    			$id_category = self::getIdentifier('id_category','category_lang',Tools::getValue('rewrite'));
    			$_GET['id_category'] = $id_category;
    		}elseif ($php_self == 'supplier') {
    			$id_supplier = self::getExtraIdentifier('id_supplier','supplier',Tools::getValue('rewrite'));
    			$_GET['id_supplier'] = $id_supplier;
    		}elseif ($php_self == 'manufacturer') {
    			$id_manufacturer = self::getExtraIdentifier('id_manufacturer','manufacturer',Tools::getValue('rewrite'));
    			$_GET['id_manufacturer'] = $id_manufacturer;
    		}elseif ($php_self == 'cms') {
    			if(isset($_GET['subcontroller']) && !empty($_GET['subcontroller']) && $_GET['subcontroller'] == 'cms_category'){
    				$id_cms_category = self::getIdentifier('id_cms_category','cms_category_lang',Tools::getValue('rewrite'));
    				$_GET['id_cms_category'] = $id_cms_category;
    			}else{
    				$id_cms = self::getIdentifier('id_cms','cms_lang',Tools::getValue('rewrite'));
    				$_GET['id_cms'] = $id_cms;
    			}
    		}elseif ($php_self == 'product') {
    			$id_product = self::getIdentifier('id_product','product_lang',Tools::getValue('rewrite'));
    			$_GET['id_product'] = $id_product;
    		}
    	}
    }
    public static function getExtraIdentifier($identifier = 'id_manufacturer',$table = 'manufacturer',$link_rewrite = 'fashion-manufacturer')
    {
    	$cache_key = $identifier.$table.$link_rewrite;
    	if(!Cache::isStored($cache_key)){
	    	$sql = "SELECT `".$identifier."` FROM `"._DB_PREFIX_.$table."` WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(LOWER(`name`), ' ', '-'), '\'', '-'), '&', ''), '.', ''), ',', ''), '--', '-') = '".$link_rewrite."'";
		    $getIdentifier = DB::getInstance()->getValue($sql);
		    if(isset($getIdentifier) && !empty($getIdentifier)){
		    	Cache::store($cache_key,$getIdentifier);
		    }
    	}
	    return Cache::retrieve($cache_key);
    }
    public static function getIdentifier($identifier = 'id_product',$table = 'product_lang',$link_rewrite = 'blouse')
    {
		$id_shop = (int)Context::getContext()->shop->id;
		$id_lang = (int)Context::getContext()->language->id;
    	$cache_key = $identifier.$table.$link_rewrite.$id_lang.$id_shop;
    	if(!Cache::isStored($cache_key)){
		    $sql = 'SELECT `'.$identifier.'` FROM `'._DB_PREFIX_.$table.'` WHERE `link_rewrite` = "'.$link_rewrite.'" AND `id_lang` = '.$id_lang.' AND `id_shop` = '.$id_shop;
		    $getIdentifier = DB::getInstance()->getValue($sql);
		    if(isset($getIdentifier) && !empty($getIdentifier)){
    			Cache::store($cache_key,$getIdentifier);
		    }else{
    			$id_lang_def = (int)Configuration::get('PS_LANG_DEFAULT');
    	    	$sql2 = 'SELECT `'.$identifier.'` FROM `'._DB_PREFIX_.$table.'` WHERE `link_rewrite` = "'.$link_rewrite.'" AND `id_lang` = '.$id_lang_def.' AND `id_shop` = '.$id_shop;
    	    	$getIdentifier2 = DB::getInstance()->getValue($sql2);
    	    	Cache::store($cache_key,$getIdentifier2);
		    }
    	}
		return Cache::retrieve($cache_key);
    }
	public function postProcess()
	{
		if (Tools::isSubmit('submit'.$this->name))
		{
			Configuration::updateValue('smseourl_ishtml',Tools::getValue('smseourl_ishtml'));
			Configuration::updateValue('smseourl_product_slug',Tools::getValue('smseourl_product_slug'));
			Configuration::updateValue('smseourl_category_slug',Tools::getValue('smseourl_category_slug'));
			Configuration::updateValue('smseourl_manufacture_slug',Tools::getValue('smseourl_manufacture_slug'));
			Configuration::updateValue('smseourl_supplier_slug',Tools::getValue('smseourl_supplier_slug'));
			Configuration::updateValue('smseourl_cms_slug',Tools::getValue('smseourl_cms_slug'));
			Configuration::updateValue('smseourl_cms_category_slug',Tools::getValue('smseourl_cms_category_slug'));
			$this->setRoutes();
			return $this->displayConfirmation($this->l('The settings have been updated.'));
		}
		return '';
	}
	public function getContent()
	{
		$html = '<a style="margin-bottom:50px;margin-left:20px" href="mailto:kamrulbd36@gmail.com" target="_blank"><img  style="margin-bottom:50px;margin-left:20px" src="'.$this->_path.'/image/hire-us.jpg" alt="hire-us"></a>';
		return $this->postProcess().$this->renderForm().$html;
	}
	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('SEO URL Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Product Page Slug'),
						'name' => 'smseourl_product_slug',
						'placeholder' => 'product',
						'desc' => 'http://site-url.com/{product}/name',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Category Page Slug'),
						'name' => 'smseourl_category_slug',
						'placeholder' => 'category',
						'desc' => 'http://site-url.com/{category}/name',
					),
					array(
						'type' => 'text',
						'label' => $this->l('manufacture Page Slug'),
						'name' => 'smseourl_manufacture_slug',
						'placeholder' => 'manufacture',
						'desc' => 'http://site-url.com/{manufacture}/name',
					),
					array(
						'type' => 'text',
						'label' => $this->l('supplier Page Slug'),
						'name' => 'smseourl_supplier_slug',
						'placeholder' => 'supplier',
						'desc' => 'http://site-url.com/{supplier}/name',
					),
					array(
						'type' => 'text',
						'label' => $this->l('cms Page Slug'),
						'name' => 'smseourl_cms_slug',
						'placeholder' => 'cms',
						'desc' => 'http://site-url.com/{cms}/name',
					),
					array(
						'type' => 'text',
						'label' => $this->l('CMS Category Page Slug'),
						'name' => 'smseourl_cms_category_slug',
						'placeholder' => 'cms-category',
						'desc' => 'http://site-url.com/{cms-category}/name',
					),
					array(
					    'type' => 'switch',
					    'label' => $this->l('Use .html'),
					    'name' => 'smseourl_ishtml',
					    'desc' => 'Do you want to use .html postfix in your each url? like http://site-url.com/product<strong>.html</strong> instead of http://site-url.com/product',
					    'required' => false,
					    'class' => 't',
					    'is_bool' => true,
					    'values' => array(
					        array(
					            'id' => 'active',
					            'value' => 1,
					            'label' => $this->l('Enabled')
					        ),
					        array(
					            'id' => 'active',
					            'value' => 0,
					            'label' => $this->l('Disabled')
					        )
					    )
					),
				),
				'submit' => array(
					'title' => $this->l('Save')
				)
			),
		);
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table =  $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->module = $this;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submit'.$this->name;
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'uri' => $this->getPathUri(),
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);
		return $helper->generateForm(array($fields_form));
	}
	public function getConfigFieldsValues()
	{
		$fields = array();
		$fields['smseourl_ishtml'] = Tools::getValue('smseourl_ishtml', Configuration::get('smseourl_ishtml'));
		$fields['smseourl_product_slug'] = Tools::getValue('smseourl_product_slug', Configuration::get('smseourl_product_slug'));
		$fields['smseourl_category_slug'] = Tools::getValue('smseourl_category_slug', Configuration::get('smseourl_category_slug'));
		$fields['smseourl_manufacture_slug'] = Tools::getValue('smseourl_manufacture_slug', Configuration::get('smseourl_manufacture_slug'));
		$fields['smseourl_supplier_slug'] = Tools::getValue('smseourl_supplier_slug', Configuration::get('smseourl_supplier_slug'));
		$fields['smseourl_cms_slug'] = Tools::getValue('smseourl_cms_slug', Configuration::get('smseourl_cms_slug'));
		$fields['smseourl_cms_category_slug'] = Tools::getValue('smseourl_cms_category_slug', Configuration::get('smseourl_cms_category_slug'));
		return $fields;
	}
}