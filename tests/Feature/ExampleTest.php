<?php

test('the home page redirects to portfolio details', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('portfolio-details.index'));
});
