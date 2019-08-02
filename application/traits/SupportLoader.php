<?php

trait SupportLoader
{
	/**
	 * Get the dynamic object of CI
	 *
	 * @param  string $method
	 * @param  array $args
	 *
	 * @return object
	 */
	public function __call($method, $args = [])
	{
        return load_class($this->classLoaded($method), 'core', $args);
    }

    public function isApi()
    {
        $this->loader()->helper('Constant');
        $pattern = '#^'.(Constant::PREFIX_API ?? 'api').'#i';
        return preg_match($pattern, $this->uri()->uri_string()) === 1;
    }

    /**
     * Get the exact name of the loaded class from the given name
     *
     * @param  string $name
     *
     * @return string
     */
    private function classLoaded($name)
    {
        return ($name == 'uri') ? strtoupper($name) : ucfirst($name);
    }
}
