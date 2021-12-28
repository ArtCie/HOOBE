<?php

interface RepositoryInterface
{
    public function prepare_url($coordinates);
    public function get_data();
    public function send_request($URL);
}