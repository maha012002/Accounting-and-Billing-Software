<?php
/**
 * This class works with the QuickPay API for the version 5 protocol.
 * Technical documentation can be located at http://doc.quickpay.net/
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @author Dan Storm <storm@catalystcode.net>
 * @version 1
 * @link https://github.com/Repox/quickpay
 * @website http://catalystcode.net
 */
class Quickpay {

    private $secret, $merchant, $apikey;
    private $testmode = 0;
    private $protocol = 5; // The QuickPay API protocol

    /**
     * When creating an instance of the QuickPay class you will have to provide
     * your merchant ID (quickpay ID) and your secret MD5 secret.
     *
     * API key is an alternative to IP based API access control and should be provided
     * if you haven't whitelisted your servers IP in the QuickPay Manager.
     *
     * @param integer $quickpay_id The QuickPayId
     * @param string $secret The MD5 secret code
     * @param string $secret The API key
     */
    public function __construct( $quickpay_id, $secret, $apikey = NULL )
    {
        $this->merchant = $quickpay_id;
        $this->secret = $secret;

        if( ! is_null($apikey) )
        {
            $this->apikey = $apikey;
        }

    }

    /**
     * Use this to tell whether or not the request should be treated as a test
     *
     * @param boolean $boolean Set to TRUE if you need to create a test
     */
    public function testmode( $boolean = FALSE )
    {
        $this->testmode = (int)$boolean;
    }

    /**
     * Make an authorize action
     *
     * Warning!!
     * You are only allowed to do authorizes through the Quickpay API if your setup has passed the full PCI certification.
     * Please use the Quickpay Payment Window instead.
     *
     * This message type is used when the merchant wants to validate refund card
     * data against the card issuer and authorize a transaction. The transaction
     * amount is only reserved at the card holder's account and not withdrawn
     * from the account - unless the autocapture field is set.
     *
     * @param string $ordernumber A value by merchant's own choise. Must be unique for each transaction.
     * @param int $amount The transaction amount in its smallest unit. In example, 1 EUR is written 100
     * @param string $currency The transaction currency as the 3-letter ISO 4217 alphabetical code.
     * @param string $cardnumber The refund card number
     * @param string $expirationdate The refund card expiration date (reg exp: /^[0-9]{4}$/ ie. 0914)
     * @param string $cvd The refund card verification data
     * @param boolean $autocapture If set to TRUE, the transaction will be captured automatically - provided that the authorize was succesful
     * @return object An object with response fields according to the documentation
     */
    public function authorize($ordernumber, $amount, $currency, $cardnumber, $expirationdate, $cvd, $autocapture = FALSE )
    {
        $data_fields['msgtype'] = 'authorize';
        $data_fields['ordernumber'] = $ordernumber;
        $data_fields['amount'] = $amount;
        $data_fields['currency'] = $currency;
        $data_fields['cardnumber'] = $cardnumber;
        $data_fields['expirationdate'] = $expirationdate;
        $data_fields['cvd'] = $cvd;
        $data_fields['autocapture'] = (int)$autocapture;

        return $this->_query($data_fields);
    }

    /**
     * Make a subscribe action
     *
     * Warning!!
     * You are only allowed to do subscribes through the Quickpay API if your setup has passed the full PCI certification.
     * Please use the Quickpay Payment Window instead.
     *
     * Like the message type authorize, this message type is used when the merchant
     * wants to validate refund card data against the card issuer.
     * When the merchant wants to make a withdrawal from the subscription,
     * the id from this transaction is used as a reference for message type recurring.
     *
     * @param string $ordernumber A value by merchant's own choise. Must be unique for each transaction.
     * @param string $description A value by the merchant's own choise. Used for identifying a subscription payment
     * @param string $cardnumber The refund card number
     * @param string $expirationdate The refund card expiration date (reg exp: /^[0-9]{4}$/ ie. 0914)
     * @param string $cvd The refund card verification data
     * @return object An object with response fields according to the documentation
     */
    public function subscribe($ordernumber, $description, $cardnumber, $expirationdate, $cvd )
    {
        $data_fields['msgtype'] = 'subscribe';
        $data_fields['ordernumber'] = $ordernumber;
        $data_fields['cardnumber'] = $cardnumber;
        $data_fields['expirationdate'] = $expirationdate;
        $data_fields['cvd'] = $cvd;
        $data_fields['description'] = $description;

        return $this->_query($data_fields);
    }
    /**
     * Make a recurring action
     *
     * This message type is used when the merchant wants to make a withdrawal from a subscription.
     * The transaction amount is only reserved at the card holder's account and not withdrawn
     * from the account - unless the autocapture field is set.
     *
     * @param string $ordernumber A value by merchant's own choise. Must be unique for each transaction.
     * @param int $amount The transaction amount in its smallest unit. In example, 1 EUR is written 100
     * @param string $currency The transaction currency as the 3-letter ISO 4217 alphabetical code.
     * @param string $transaction A transaction id from a previous transaction (identifying the subscription).
     * @param boolean $autocapture If set to TRUE, the transaction will be captured automatically - provided that the authorize was succesful
     * @return object An object with response fields according to the documentation
     */
    public function recurring($ordernumber, $amount, $currency, $transaction, $autocapture = FALSE )
    {
        $data_fields['msgtype'] = 'recurring';
        $data_fields['ordernumber'] = $ordernumber;
        $data_fields['amount'] = $amount;
        $data_fields['currency'] = $currency;
        $data_fields['transaction'] = $transaction;
        $data_fields['autocapture'] = (int)$autocapture;

        return $this->_query($data_fields);
    }

    /**
     * Make a cancel action
     *
     * This message type is used when the merchant wants to cancel the order.
     * A cancellation will delete the reservation on the cardholders account.
     *
     * @param string $transaction A transaction id from a previous transaction.
     * @return object An object with response fields according to the documentation
     */
    public function cancel($transaction)
    {
        $data_fields['msgtype'] = 'cancel';
        $data_fields['transaction'] = $transaction;

        return $this->_query($data_fields);
    }

    /**
     * Make a renew action
     *
     * This message type is used when the merchant wants to renew an authorized transaction.
     *
     * @param string $transaction A transaction id from a previous transaction.
     * @return object An object with response fields according to the documentation
     */
    public function renew($transaction)
    {
        $data_fields['msgtype'] = 'renew';
        $data_fields['transaction'] = $transaction;

        return $this->_query($data_fields);
    }

    /**
     * Make a capture action
     *
     * This message type is used when the merchant wants to
     * transfer part of or the entire transaction amount from the cardholders account.
     *
     * @param string $transaction A transaction id from a previous transaction.
     * @param int $amount The transaction amount in its smallest unit. In example, 1 EUR is written 100
     * @param boolean $finalize If set to TRUE, this will finalize multiple partial capture. When set transaction will go into a closed state and no more captures will be possible.
     * @return object An object with response fields according to the documentation
     */
    public function capture($transaction, $amount, $finalize = FALSE)
    {
        $data_fields['msgtype'] = 'capture';
        $data_fields['transaction'] = $transaction;
        $data_fields['amount'] = $amount;
        $data_fields['finalize'] = (int)$finalize;

        return $this->_query($data_fields);
    }

    /**
     * Make a refund action
     *
     * This message type is used when the merchant wants to transfer part of
     *  or the entire transaction amount to the cardholders account.
     *
     * @param string $transaction A transaction id from a previous transaction.
     * @param int $amount The transaction amount in its smallest unit. In example, 1 EUR is written 100
     * @return object An object with response fields according to the documentation
     */
    public function refund($transaction, $amount)
    {
        $data_fields['msgtype'] = 'refund';
        $data_fields['transaction'] = $transaction;
        $data_fields['amount'] = $amount;

        return $this->_query($data_fields);
    }
    /**
     * Make a status action
     *
     * This message type is used when the merchant wants to check the status of a transaction.
     * The response from this message type differs from the others as it contains the history
     * of the transaction as well.
     *
     * @param string $transaction A transaction id from a previous transaction.
     * @return object An object with response fields according to the documentation
     */
    public function status($transaction)
    {
        $data_fields['msgtype'] = 'status';
        $data_fields['transaction'] = $transaction;

        return $this->_query($data_fields);
    }

    /**
     * Make a status action from the ordernumber
     *
     * This message type is used when the merchant wants to check the status of a transaction.
     * The response from this message type differs from the others as it contains the history
     * of the transaction as well.
     *
     * @param string $ordernumber An ordernumber from a previous transaction.
     * @return object An object with response fields according to the documentation
     */
    public function status_from_order($ordernumber)
    {
        $data_fields['msgtype'] = 'refund';
        $data_fields['ordernumber'] = $ordernumber;

        return $this->_query($data_fields);
    }
    /**
     * Handles the response for the callback URL.
     *
     * @param array $data The postdata - if not set, it will fetch it automatically.
     * @return object An object with response fields according to the documentation
     */
    public function callback($data = NULL)
    {
        if( is_null($data) )
        {
            $data = $_POST;
        }
        return $this->_response($data);
    }

    /**
     * Generate the hidden fields for the QuickPay Payment Window.
     *
     * @param array $input_data The form data to send with the request
     * @param boolean $xhtml Set to TRUE to close tags in XHTML form.
     * @return string The hidden fields in HTML form.
     */
    public function form_fields($input_data, $xhtml = FALSE)
    {
        $reserved_fields = array('protocol', 'merchant', 'testmode');
        $valid_input_ordered = array('protocol', 'msgtype', 'merchant', 'language', 'ordernumber', 'amount', 'currency', 'continueurl', 'cancelurl', 'callbackurl', 'autocapture', 'autofee', 'cardtypelock', 'description', 'group', 'testmode', 'splitpayment', 'forcemobile', 'deadline');

        foreach($valid_input_ordered as $key)
        {
            // Is the key a reserved field?
            if(in_array($key, $reserved_fields))
            {
                $data_fields[$key] = $this->{$key};
                continue;
            }

            if(isset($input_data[$key]))
            {
                $data_fields[$key] = $input_data[$key];
            }
        }

        $html = '';
        $html_end = ($xhtml) ? ' />' : '>';
        $data_fields['md5check'] = md5(implode("", $data_fields) . $this->secret);
        foreach($data_fields as $key => $value)
        {
            $html .= '<input type="hidden" name="'.$key.'" value="'.$value.'"'.$html_end;
        }

        return $html;
    }
    /**
     * Calls the API
     *
     * @param array $data_fields An array filled with nessecary information for making the request
     * @return object An object with response fields according to the documentation
     */
    private function _query($data_fields)
    {
        $data_fields = $this->_build_data_fields($data_fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://secure.quickpay.dk/api');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_fields);

        $content = curl_exec($ch);
        curl_close($ch);

        return $this->_response($content);
    }
    /**
     * Handles the response from
     *
     * @param array $data_fields An array filled with nessecary information for making the request
     * @return object An object with response fields according to the documentation
     */
    private function _response($xml)
    {
        try
        {
            $xml = new SimpleXMLElement($xml);
        }
        catch( Exception $e)
        {}

        $response = new stdClass();
        $md5string = '';
        foreach($xml as $key => $value)
        {
            $response->{$key} = (string)$value;
            if($key != 'md5check' && $key != 'history')
            {
                $md5string .= (string)$value;
            }
        }

        if(isset($xml->history))
        {
            $response->history = array();
            foreach($xml->history as $history)
            {
                $obj = new stdClass();
                foreach($history as $key => $value)
                {
                    $obj->{$key} = (string)$value;
                }
                $response->history[] = $obj;
            }
        }

        // Make sure the data hasn't been tampered with.
        $response->is_valid = (md5($md5string . $this->secret) == $response->md5check);
        return $response;
    }

    /**
     * Builds the data request fields and makes sure they have the correct order and md5 checksum.
     *
     * @param array $data_fields An array filled with nessecary information for making the request
     * @return array An array witht the sorted data and a md5 checksum.
     */
    private function _build_data_fields( $input_data )
    {
        // Fraud Protection
        $referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
        $fraud_fields = array('fraud_remote_addr' => $_SERVER['REMOTE_ADDR'], 'fraud_http_accept' => $_SERVER['HTTP_ACCEPT'], 'fraud_http_accept_language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'], 'fraud_http_accept_encoding' => $_SERVER['HTTP_ACCEPT_ENCODING'], 'fraud_http_accept_charset' => $_SERVER['HTTP_ACCEPT_CHARSET'], 'fraud_http_referer' => $referer, 'fraud_http_user_agent' => $_SERVER['HTTP_USER_AGENT']);
        $input_data = array_merge($input_data, $fraud_fields);

        // Make sure fields are aggregated and has the correct order
        $reserved_fields = array('protocol', 'merchant', 'testmode', 'apikey');
        $valid_fields_ordered = array('protocol', 'channel', 'msgtype', 'merchant', 'ordernumber', 'amount', 'currency', 'autocapture', 'cardnumber', 'expirationdate', 'cvd', 'mobilenumber', 'smsmessage', 'cardtypelock', 'finalize', 'transaction', 'description', 'splitpayment', 'testmode', 'fraud_remote_addr', 'fraud_http_accept', 'fraud_http_accept_language', 'fraud_http_accept_encoding', 'fraud_http_accept_charset', 'fraud_http_referer', 'fraud_http_user_agent', 'apikey');

        // The final field array
        $data_fields = array();
        foreach($valid_fields_ordered as $key)
        {
            // Is the key a reserved field?
            if(in_array($key, $reserved_fields))
            {
                $data_fields[$key] = $this->{$key};
                continue;
            }

            if(isset($input_data[$key]))
            {
                $data_fields[$key] = $input_data[$key];
            }
        }


        $data_fields['md5check'] = md5(implode("", $data_fields).$this->secret);
        var_dump($data_fields);
        return $data_fields;
    }
}