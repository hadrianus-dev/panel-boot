<?php

it('has api\tronus\church page', function () {
    $response = $this->get('/api\tronus\church');

    $response->assertStatus(200);
});
