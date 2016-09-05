<?php
namespace Intraxia\Gistpen\Test;

use Intraxia\Gistpen\App;
use Intraxia\Jaxion\Core\UndefinedAliasException;
use Mockery;
use WP_UnitTestCase;

abstract class TestCase extends WP_UnitTestCase {
	/**
	 * @var Factory
	 */
	protected $factory;

	/**
	 * @var App
	 */
	protected $app;

	/**
	 * @var \WP_Post
	 */
	protected $repo;

	/**
	 * @var int[]
	 */
	protected $blobs;

	/**
	 * @var \WP_Term
	 */
	protected $language;

	public function setUp() {
		parent::setUp();
		$this->factory = new Factory;
		$this->app     = App::instance();
	}

	public function tearDown() {
		parent::tearDown();

		Mockery::close();
		cmb2_update_option( 'wp-gistpen', '_wpgp_gist_token', false );
	}

	public function mock( $alias ) {
		try {
			$to_mock = $this->app->fetch( $alias );

			return Mockery::mock( get_class( $to_mock ) );
		} catch ( UndefinedAliasException $e ) {
			return Mockery::mock( $alias );
		}
	}

	public function create_post_and_children() {
		$this->repo = $this->factory->gistpen->create_and_get();

		$this->blobs = $this->factory->gistpen->create_many( 3, array(
			'post_parent' => $this->repo->ID
		) );

		foreach ( $this->blobs as $blob ) {
			wp_set_object_terms( $blob, 'php', 'wpgp_language', false );
		}

		$this->language = get_term_by( 'slug', 'php', 'wpgp_language' );

		update_post_meta( $this->repo->ID, '_wpgp_gist_id', 'none' );
	}

}
