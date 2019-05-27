<?php

interface interfaceObserver {
    function update(interfaceSubject $subject_in);
}

interface interfaceSubject {
    function attach(interfaceObserver $observer_in);
    function detach(interfaceObserver $observer_in);
    function notify();
}



class PatternObserver implements interfaceObserver {
    public function __construct() {}
    public function update(interfaceSubject $subject) {

      echo $subject->getData() . "<br />";
         
    }
}

class PatternSubject implements interfaceSubject {
      private $observers;
      private $data;
      public function setObservers()
      {
        $this->observers = new SplObjectStorage();
      }
      public function attach(interfaceObserver $observer)
      {
        $this->observers->attach($observer);
      }
      public function detach(interfaceObserver $observer)
      {
        $this->observers->detach($observer);
      }
      public function notify()
      {
          foreach ($this->observers as $observer) {
          $observer->update($this);
          }
      }
      public function setData($dataNow)
      {
        $this->data=$dataNow;
      }
      public function getData()
       {
          return $this->data;
    }
  }