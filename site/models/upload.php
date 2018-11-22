<?php
// For a content file called `project.txt`
// In general the class name is {{ProjectFileName}}Page

class UploadPage extends Page {
	
	const ERROR = "ERROR MSG:";
	
  public function getErrors() {
    return self::ERROR;
  }
}