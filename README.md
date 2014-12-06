# extension for Grido Grid

see https://packagist.org/packages/o5/grido

# usage
# boostrap

JO\Nette\Grido\Components\Filters\DateRangeExt::register();

# create data grid

$this->dg  - instance of Grido grid
$dtExample = '1.1.2014-31.5.2014';
$this->dg
	->addFilterDateRangeExt('orderDate', $this->getColumnLabel('orderDate'))
    ->getControl()->getControlPrototype()->attrs['placeholder'] = $dtExample;

$this->dg->getFilter('orderDate')->getControl()->getControlPrototype()->attrs['title'] = $dtExample;