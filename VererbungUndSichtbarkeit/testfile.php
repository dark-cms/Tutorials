<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
Class Output
{
	public function __construct($called, $function, $class, $self, $public, $private, $protected) {
		echo '<div style="background-color: black; color: white">';
		echo "Es wurde die Funktion $function durch die Klasse <span style='background-color: $called'>$called</span> aufgerufen.<br />Die aktuelle Klasse (get_class(null)) ist <span style='background-color: $class'>$class</span>, get_class(\$this) gibt <span style='background-color: $self'>$self</span> zurück<br />";
		echo "<dl>
			<dt>public</dt>
			<dd style='background-color: $public'>$public</dd>
			<dt>private</dt>
			<dd style='background-color: $private'>$private</dd>
			<dt>protected</dt>
			<dd style='background-color: $protected'>$protected</dd>
			</dl>";
		echo '</div>';
	}
}


class Red
{
	private $private = 'Red';
	public  $public = 'Red';
	protected $protected = 'Red';

	public function getthisRedvars ()
	{
		new Output(get_called_class (), 'getthisRedvars', get_class(), get_class($this), $this->public, $this->private,$this->protected);
	}
	public function changeRedPrivate()
	{
		$this->private = 'lightGreen';
	}
	public function changeRedProtected()
	{
		$this->protected = 'lightGreen';
	}

	private function getviaPrivate()
	{
		new Output(get_called_class (), 'getviaPrivate', get_class(), get_class($this), $this->public, $this->private,$this->protected);
	}

	public function getviaRedPrivateBypass()
	{
		$this->getviaPrivate();
	}

	public function getviaParentPrivateBypass()
	{
		$this->getviaPrivate();
	}

	protected function getviaProtected(){
		new Output(get_called_class (), 'getviaProtected', get_class(), get_class($this), $this->public, $this->private,$this->protected);
	}
	
	public function getviaRedProtectedBypass()
	{
		$this->getviaProtected();
	}

	public function getviaParentProtectedBypass()
	{
		$this->getviaProtected();
	}
}

class Blue extends Red {
	private $private = 'Blue';
	public  $public = 'Blue';
	protected $protected = 'Blue';

	public function getthisBluevars ()
	{
		new Output(get_called_class (), 'getthisBluevars', get_class(), get_class($this), $this->public, $this->private,$this->protected);
	}
	public function changeBluePrivate()
	{
		$this->private = 'darkGreen';
	}
	public function changeBlueProtected()
	{
		$this->protected = 'darkGreen';
	}

	private function getviaPrivate()
	{
		new Output(get_called_class (), 'getviaPrivate', get_class(), get_class($this), $this->public, $this->private,$this->protected);
	}
	public function getviaBluePrivateBypass()
	{
		$this->getviaPrivate();
	}
	/*
	protected function getviaProtected()
	{
		new Output(get_called_class (), 'getviaProtected', get_class(), get_class($this), $this->public, $this->private,$this->protected);
	}
*/
	public function getviaBlueProtectedBypass()
	{
		$this->getviaProtected();
	}
}

echo '<h1>Erster Test getthisXXXvars ohne Änderungen</h1>';
$red = new Red;
$blue = new Blue;
$red->getthisRedvars();
$blue->getthisBluevars();
$blue->getthisRedvars();
echo '<hr />';
echo '<h1>Zweiter Test getthisXXXvars mit vorheriger Änderungen der Publics</h1>';
$red = new Red;
$blue = new Blue;
//$red->private = 'Green'; //Fatal error: Cannot access private property Red::$private
$red->public = 'LightGreen';
//$red->protected = 'Green'; //Fatal error: Cannot access protected property Red::$protected

//$blue->private = 'Green'; //Fatal error: Cannot access private property Blue::$private
$blue->public = 'darkGreen';
//$blue->protected = 'Green'; //Fatal error: Cannot access protected property Blue::$protected
$red->getthisRedvars();
$blue->getthisBluevars();
$blue->getthisRedvars();
echo '<hr />';
echo '<h1>Dritter Test getthisRedvars mit vorheriger Änderungen der Protected und Private mit changeRedProtected und changeRedPrivate</h1>';
$red = new Red;
$red->changeRedProtected();
$red->changeRedPrivate();
$red->getthisRedvars();
echo '<hr />';
echo '<h1>Vierter Test getthisXXXvars mit vorheriger Änderungen der Protected und Private mit changeBLUEProtected und changeBLUEPrivate</h1>';
$blue = new Blue;
$blue->changeBlueProtected();
$blue->changeBluePrivate();
$blue->getthisBluevars();
$blue->getthisRedvars();
echo '<hr />';
echo '<h1>Fünfter Test getthisXXXvars mit vorheriger Änderungen der Protected und Private mit changeREDProtected und changeREDPrivate</h1>';
$blue = new Blue;
$blue->changeRedProtected();
$blue->changeRedPrivate();
$blue->getthisBluevars();
$blue->getthisRedvars();
echo '<hr />';
echo '<h1>Sechster Test über ByPass für Private-Funktionen</h1>';
$red = new Red;
$blue = new Blue;
//$red->getviaPrivate(); //Fatal error: Call to private method Red::getviaPrivate() from context '' 
//$blue->getviaPrivate(); //Fatal error: Call to private method Red::getviaPrivate() from context '' 
$red->getviaRedPrivateBypass();
$blue->getviaBluePrivateBypass();
$blue->getviaParentPrivateBypass();
echo '<hr />';
echo '<h1>Siebenter Test über ByPass für Protected-Funktionen</h1>';
$red = new Red;
$blue = new Blue;
//$red->getviaProtected(); //Fatal error: Call to private method Red::getviaProtected() from context '' 
//$blue->getviaProtected(); //Fatal error: Call to private method Red::getviaProtected() from context '' 
$red->getviaRedProtectedBypass();
$blue->getviaBlueProtectedBypass();
$blue->getviaParentProtectedBypass();
