<?php

namespace DoctrineORMModule\Proxy\__CG__\Base\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class BaseVideos extends \Base\Entity\BaseVideos implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'titulo', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'idVideos', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'urlYoutube', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'conteudoOriginal');
        }

        return array('__isInitialized__', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'titulo', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'idVideos', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'urlYoutube', '' . "\0" . 'Base\\Entity\\BaseVideos' . "\0" . 'conteudoOriginal');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (BaseVideos $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getIdVideos()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getIdVideos();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdVideos', array());

        return parent::getIdVideos();
    }

    /**
     * {@inheritDoc}
     */
    public function getUrlYoutube()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUrlYoutube', array());

        return parent::getUrlYoutube();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdVideos($idVideos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdVideos', array($idVideos));

        return parent::setIdVideos($idVideos);
    }

    /**
     * {@inheritDoc}
     */
    public function setUrlYoutube($urlYoutube)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUrlYoutube', array($urlYoutube));

        return parent::setUrlYoutube($urlYoutube);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitulo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitulo', array());

        return parent::getTitulo();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitulo($titulo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitulo', array($titulo));

        return parent::setTitulo($titulo);
    }

    /**
     * {@inheritDoc}
     */
    public function getConteudoOriginal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConteudoOriginal', array());

        return parent::getConteudoOriginal();
    }

    /**
     * {@inheritDoc}
     */
    public function setConteudoOriginal($conteudoOriginal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setConteudoOriginal', array($conteudoOriginal));

        return parent::setConteudoOriginal($conteudoOriginal);
    }

}
