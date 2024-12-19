<?php
namespace Wtpdf\Ubl\Invoice\Formats;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !class_exists( '\\Wtpdf\\UBL\\Invoice\\Formats\\UblCiusRo' ) ) {
    class UblCiusRo extends \Wtpdf\Ubl\Documents\Invoice {
        CONST INVOICE_TYPE_CODE = '380';

        public $order = null;
        protected $typcode = self::INVOICE_TYPE_CODE;
        public $elements = array();
        public $ubl_format_name = 'ubl_cius_es';
        public $data_format = 'Y-m-d';

        public function __construct( $order = null ) {
            parent::__construct();
            $this->order = $order;
            $this->elements = array(
                
                // BT-24: Specification identifier or Customization identifier.
                'specification' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_specification(),
                ),

                // BT-23: Profile identifier is not available for this format.
                'profile_identifier' => array(
                    'enabled' => false,
                    'value_arr' => '',
                ),

                // BT-1: Invoice number.
                'invoice_number' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_number( $this->order, $this->ubl_format_name ),
                ),

                // BT-2: Invoice issue date.
                'issue_date' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_issue_date( $this->order, $this->ubl_format_name ),
                ),

                // BT-9: Invoice due date.
                'due_date' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_due_date( $this->order, $this->ubl_format_name ),
                ),

                // BT-3: Invoice type code.
                'invoice_typecode' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_typecode(),
                ),

                // BT-22: Invoice notes.
                'notes' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_notes( $this->order, $this->ubl_format_name ),
                ),

                // BT-7: Invoice tax point date.
                'tax_points_date' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_tax_points_date( $this->order, $this->ubl_format_name ),
                ),

                // BT-5: Invoice currency code.
                'currency_code' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_currency_code( $this->order, $this->ubl_format_name ),
                ),

                // BT-6: Invoice tax currency code.
                'tax_currency_code' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_tax_currency_code( $this->order, $this->ubl_format_name ),
                ),

                // BT-19: Buyer accounting reference.
                'buyer_accounting_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_buyer_accounting_reference( $this->order, $this->ubl_format_name ),
                ),

                // BT-10: Buyer reference.
                'buyer_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_buyer_reference( $this->order, $this->ubl_format_name ),
                ),

                // BG-14: Invoice period.
                'invoice_period' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_period( $this->order, $this->ubl_format_name ),
                ),

                // BT-13: Purchase order reference and BT-14: Sales order reference
                'order_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_order_reference( $order, $this->ubl_format_name ),
                    
                ),

                // BG-3: Originator document reference.
                'originator_document_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_originator_document_reference( $this->order, $this->ubl_format_name ),
                ),

                // BT-12: Contract document reference.
                'contract_document_reference' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_contract_document_reference( $this->order, $this->ubl_format_name ),
                ),

                // BG-24: Attachments node


                // Seller node
                'seller' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_accounting_supplier_party( $this->order, $this->ubl_format_name ),
                ),

                // Buyer node
                'buyer' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_accounting_customer_party( $this->order, $this->ubl_format_name ),
                ),

                
                // Payee node
                // Delivery node
                // Payment nodes
                // Allowances and charges

                // Invoice totals
                'tax_subtotal' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_tax_subtotal_details(),
                ),

                // legal monitory tax total
                'legal_monitory_tax_total' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_legal_monitory_tax_total(),
                ),

                // Invoice lines
                'invoice_lines' => array(
                    'enabled' => true,
                    'value_arr' => $this->get_formatted_invoice_lines(),
                ),
            );
        }

        /**
         * Creates a new instance of the class.
         *
         * This method returns a new instance of the class, optionally initialized with an order.
         *
         * @param mixed $order Optional. The order to initialize the instance with. Default is null.
         * @return self A new instance of the class.
         */
        public static function instance( $order = null ) {
            return new self( $order);
        }

        /**
         * Retrieves the document namespace for the UBL CIUS RO invoice format.
         *
         * This method returns an associative array containing the XML namespaces
         * required for the UBL (Universal Business Language) CIUS RO invoice format.
         *
         * @return array An associative array with the following keys:
         *               - 'xmlns': The main UBL invoice namespace.
         *               - 'xmlns:cac': The namespace for Common Aggregate Components.
         *               - 'xmlns:cbc': The namespace for Common Basic Components.
         */
        public function get_document_namespace() {
            return array(
                'xmlns' => 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2',
                'xmlns:cac' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2',
                'xmlns:cbc' => "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
            );
        }
        
        /**
         * Retrieves the formatted elements for the UBL invoice.
         *
         * This method applies the 'wtpdf_ubl_format_elements' filter to the elements
         * of the UBL invoice, allowing for customization of the formatted elements.
         *
         * @return array The formatted elements for the UBL invoice.
         *
         * @hook wtpdf_ubl_format_elements Allows customization of the formatted elements.
         * @param array $elements The elements of the UBL invoice.
         * @param object $order The WooCommerce order object.
         * @param string $context The context in which the filter is applied, in this case 'ublinvoice'.
         */
        public function get_formatted_elements() {
            return apply_filters( 'wtpdf_ubl_format_elements', $this->elements, $this->order, 'ublinvoice' );
        }
        
        /**
         * Retrieves the specification string for the UBL CIUS-RO format.
         *
         * This method returns a string that specifies the UBL CIUS-RO format,
         * which is compliant with the EN 16931 standard and the Romanian e-invoicing
         * requirements (CIUS-RO version 1.0.1).
         *
         * @return string The specification string for the UBL CIUS-RO format.
         */
        public function get_specification(): string {
            return "urn:cen.eu:en16931:2017#compliant#urn:efactura.mfinante.ro:CIUS-RO:1.0.1";
        }

        /**
         * Retrieves the formatted specification for the UBL CIUS RO invoice.
         *
         * This method returns an associative array containing the name and value
         * of the specification. The 'name' key holds the string 'cbc:CustomizationID',
         * and the 'value' key holds the result of the get_specification() method.
         *
         * @return array An associative array with 'name' and 'value' keys.
         */
        public function get_formatted_specification(): array {
            return array(
                'name' => 'cbc:CustomizationID',
                'value' => $this->get_specification(),
            );
        }

        /**
         * Retrieves the invoice type code for a given order.
         *
         * @param object $order The WooCommerce order object.
         * @return string The invoice type code.
         */
        public function get_invoice_typecode( $order ): string {
            return $this->typcode;
        }

        /**
         * Retrieves the formatted invoice type code.
         *
         * This method returns an associative array containing the name and value
         * of the invoice type code. The 'name' key holds the string 'cbc:InvoiceTypeCode',
         * and the 'value' key holds the result of the get_invoice_typecode method
         * called with the current order.
         *
         * @return array An associative array with 'name' and 'value' keys representing
         *               the formatted invoice type code.
         */
        public function get_formatted_invoice_typecode(): array {
            return array(
                'name' => 'cbc:InvoiceTypeCode',
                'value' => $this->get_invoice_typecode( $this->order ),
            );
        }

        /**
         * Retrieves the shop's country setting.
         *
         * This method attempts to get the shop's country from the WooCommerce Packing List plugin settings.
         * If not found, it falls back to the WooCommerce default country setting.
         * If neither setting is available, it returns an empty string.
         *
         * @return string The shop's country code, or an empty string if not set.
         */
        public function get_shop_country() {
            if ( !empty( \Wf_Woocommerce_Packing_List::get_option( 'wf_country' ) ) ) {
                $result = \Wf_Woocommerce_Packing_List::get_option( 'wf_country' );   
            } else if ( !empty( get_option( 'woocommerce_default_country' ) ) ) {
                $result = get_option( 'woocommerce_default_country' );
            } else{
                $result = '';
            }
            
            // String type check before processing.
            if ( is_string( $result ) ) {
                $result = explode( ":", $result );
                return isset($result[0]) ? $result[0] : '';  // Added isset check to avoid undefined index notice.
            }
            
            return '';
        }

        /**
         * Retrieves the formatted tax subtotal details for the current WooCommerce order.
         *
         * This method processes the tax rates associated with the current order and formats them
         * into an array structure suitable for UBL (Universal Business Language) CIUS-RO invoices.
         * The formatted array includes details such as taxable amounts, tax amounts, tax categories,
         * and tax schemes, all with appropriate currency attributes.
         *
         * @return array An associative array representing the formatted tax subtotal details,
         *               structured for UBL CIUS-RO invoices.
         */
        public function get_formatted_tax_subtotal_details() {
            $formatted_tax_array = array_map( function( $item ) {
                return array(
                    'enabled' => true,
                    'name'  => 'cac:TaxSubtotal',
                    'value' => array(
                        array(
                            'name'       => 'cbc:TaxableAmount',
                            'value'      => round( $item['total_ex'], 2 ),
                            'attributes' => array(
                                'currencyID' => $this->order->get_currency(),
                            ),
                        ),
                        array(
                            'name'       => 'cbc:TaxAmount',
                            'value'      => round( $item['total_tax'], 2 ),
                            'attributes' => array(
                                'currencyID' => $this->order->get_currency(),
                            ),
                        ),
                        array(
                            'name'  => 'cac:TaxCategory',
                            'value' => array(
                                array(
                                    'name'  => 'cbc:ID',
                                    'value' => strtoupper( $item['category'] ),
                                ),
                                array(
                                    'name'  => 'cbc:Name',
                                    'value' => $item['name'],
                                ),
                                array(
                                    'name'  => 'cbc:Percent',
                                    'value' => round( $item['percentage'], 1 ),
                                ),
                                array(
                                    'name'  => 'cac:TaxScheme',
                                    'value' => array(
                                        array(
                                            'name'  => 'cbc:ID',
                                            'value' => strtoupper( $item['scheme'] ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                );
            }, $this->get_current_wc_order_tax_rates( $this->order ) );

            $formatted_tax_array = array_values( $formatted_tax_array );
            $array = array(
                'name'  => 'cac:TaxTotal',
                'value' => array(
                    array(
                        'name'       => 'cbc:TaxAmount',
                        'value'      => round( $this->order->get_total_tax(), 2 ),
                        'attributes' => array(
                            'currencyID' => $this->order->get_currency(),
                        ),
                    ),
                    $formatted_tax_array,
                ),
            );
            return $array;
        }

        /**
         * Get the formatted legal monetary tax total.
         *
         * This method calculates and returns an array representing the legal monetary total
         * for the order, including line extension amount, tax exclusive amount, tax inclusive amount,
         * and payable amount, each with their respective currency attributes.
         *
         * @return array $legalMonetaryTotal An array containing the formatted legal monetary total.
         *                                   - 'enabled' (bool): Indicates if the legal monetary total is enabled.
         *                                   - 'name' (string): The name of the legal monetary total element.
         *                                   - 'value' (array): An array of monetary values with their attributes.
         *                                       - 'name' (string): The name of the monetary value element.
         *                                       - 'value' (float): The monetary value.
         *                                       - 'attributes' (array): An array of attributes for the monetary value.
         *                                           - 'currencyID' (string): The currency ID.
         */
        public function get_formatted_legal_monitory_tax_total() {
            $total         = $this->order->get_total();
            $total_inc_tax = $total;
            $total_exc_tax = $total - $this->order->get_total_tax();

            $legalMonetaryTotal = array(
                'enabled' => false,
                'name'  => 'cac:LegalMonetaryTotal',
                'value' => array(
                    array(
                        'name'       => 'cbc:LineExtensionAmount',
                        'value'      => $total_exc_tax,
                        'attributes' => array(
                            'currencyID' => $this->order->get_currency(),
                        ),
                    ),
                    array(
                        'name'       => 'cbc:TaxExclusiveAmount',
                        'value'      => $total_exc_tax,
                        'attributes' => array(
                            'currencyID' => $this->order->get_currency(),
                        ),
                    ),
                    array(
                        'name'       => 'cbc:TaxInclusiveAmount',
                        'value'      => $total_inc_tax,
                        'attributes' => array(
                            'currencyID' => $this->order->get_currency(),
                        ),
                    ),
                    array(
                        'name'       => 'cbc:PayableAmount',
                        'value'      => $total,
                        'attributes' => array(
                            'currencyID' => $this->order->get_currency(),
                        ),
                    ),
                ),
            );

            return $legalMonetaryTotal;
        }

        /**
         * Retrieves the formatted invoice lines for the current order.
         *
         * This method processes the items in the order, including line items, fees, and shipping,
         * and formats them into an array suitable for generating UBL (Universal Business Language) invoices.
         *
         * @return array The formatted invoice lines.
         */
        public function get_formatted_invoice_lines () {
            $items = $this->order->get_items( array( 'line_item', 'fee', 'shipping' ) );
            $data = array();

            // Build the invoice lines
            foreach ( $items as $item_id => $item ) {
                $taxSubtotal      = array();
                $taxDataContainer = ( 'line_item' === $item['type'] ) ? 'line_tax_data' : 'taxes';
                $taxDataKey       = ( 'line_item' === $item['type'] ) ? 'subtotal'      : 'total';
                $lineTotalKey     = ( 'line_item' === $item['type'] ) ? 'line_total'    : 'total';
                $line_tax_data    = $item[ $taxDataContainer ];

                foreach ( $line_tax_data[ $taxDataKey ] as $tax_id => $tax ) {
                    if ( ! is_numeric( $tax ) ) {
                        continue;
                    }

                    $order_tax_data = $this->get_current_wc_order_tax_rates( $this->order );
                    $taxOrderData  = $order_tax_data[ $tax_id ];

                    $taxSubtotal[] = array(
                        'enabled' => false,
                        'name'  => 'cac:TaxSubtotal',
                        'value' => array(
                            array(
                                'name'       => 'cbc:TaxableAmount',
                                'value'      => round( $item[ $lineTotalKey ], 2 ),
                                'attributes' => array(
                                    'currencyID' => $this->order->get_currency(),
                                ),
                            ),
                            array(
                                'name'       => 'cbc:TaxAmount',
                                'value'      => round( $tax, 2 ),
                                'attributes' => array(
                                    'currencyID' => $this->order->get_currency(),
                                ),
                            ),
                            array(
                                'name'  => 'cac:TaxCategory',
                                'value' => array(
                                    array(
                                        'name'  => 'cbc:ID',
                                        'value' => strtoupper( $taxOrderData['category'] ),
                                    ),
                                    array(
                                        'name'  => 'cbc:Name',
                                        'value' => $taxOrderData['name'],
                                    ),
                                    array(
                                        'name'  => 'cbc:Percent',
                                        'value' => round( $taxOrderData['percentage'], 2 ),
                                    ),
                                    array(
                                        'name'  => 'cac:TaxScheme',
                                        'value' => array(
                                            array(
                                                'name'  => 'cbc:ID',
                                                'value' => strtoupper( $taxOrderData['scheme'] ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    );
                }

                $invoiceLine = array(
                    'enabled' => false,
                    'name'  => 'cac:InvoiceLine',
                    'value' => array(
                        array(
                            'name'  => 'cbc:ID',
                            'value' => $item_id,
                        ),
                        array(
                            'name'  => 'cbc:InvoicedQuantity',
                            'value' => $item->get_quantity(),
                            'attributes' => array(
                                'unitCode' => apply_filters( 'wtpdf_ubl_invoice_line_quantity_unit', 'H87', $item, $this->order, $this->ubl_format_name, 'ublinvoice' ),
                            ),
                        ),
                        array(
                            'name'       => 'cbc:LineExtensionAmount',
                            'value'      => round( $item->get_total(), 2 ),
                            'attributes' => array(
                                'currencyID' => $this->order->get_currency(),
                            ),
                        ),
                        array(
                            'name'  => 'cac:TaxTotal',
                            'value' => array(
                                array(
                                    'name'       => 'cbc:TaxAmount',
                                    'value'      => round( $item->get_total_tax(), 2),
                                    'attributes' => array(
                                        'currencyID' => $this->order->get_currency(),
                                    ),
                                ),
                                $taxSubtotal,
                            ),
                        ),
                        array(
                            'name'  => 'cac:Item',
                            'value' => array(
                                array(
                                    'name'  => 'cbc:Name',
                                    'value' => $item->get_name(),
                                ),
                            ),
                        ),
                    ),
                );
                
                $data[] = $invoiceLine;
                // Empty this array at the end of the loop per item, so data doesn't stack
                $taxSubtotal = array();
            }

            return $data;
        }

    }
}