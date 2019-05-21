<?php

namespace App\Model\Dolchem;


use App\Model\Products\Products;

class DolchemContent{
    public $dolchem_main_page_content,$dolchem_about_brand_profile,$dolchem_certifications,
        $dolchem_text,$dolchem_quality_assurance,$dolchem_packing,$dolchem_download_kit,
        $dolchem_markers,$dolchem_products_categories,$dolchem_products;

    /**
     * DolchemContent constructor.
     */
    public function __construct() {
        $this->dolchem_main_page_content = new MainPageContent();
        $this->dolchem_about_brand_profile = new AboutBrandProfile();
        $this->dolchem_certifications = new Certifications();
        $this->dolchem_text = new DolchemText();
        $this->dolchem_quality_assurance = new DolchemQualityAssurance();
        $this->dolchem_packing = new DolchemPacking();
        $this->dolchem_download_kit = new DolchemDownloadKit();
        $this->dolchem_markers = new DolchemMarkers();
        $this->dolchem_products_categories = new DolchemProductsCategories();
        $this->dolchem_products = new DolchemProducts();

    }
}
