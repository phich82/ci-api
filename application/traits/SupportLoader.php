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
