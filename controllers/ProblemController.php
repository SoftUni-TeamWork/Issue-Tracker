<?php

class ProblemController extends BaseController {
    public function csrfvalidationfail() {
        return $this->renderView(__FUNCTION__, false);
    }
}