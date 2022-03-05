<?php

/**
 * 
 * 
 * @author Max Olsson <max@newseed.se>
 * @package debugging
 * @version 0.1
 */
namespace Debugging {

    use Exception;

    /**
     * 
     * @author Max Olsson <max@newseed.se>
     * @version 0.1
     */
    class Message {
    
        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected int $message_id;

        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected string $content;

        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected string $callstack;
        
        /**
         * 
         * 
         * Levels:
         * 
         * 'NOTICE'     - A normal message, nothing added or needed.
         * 
         * 'DEBUG'      - A debug message. A Callstack is recommended. DEFAULT.
         * 
         * 'WARNING'    - A warning message.
         * 
         * 'ERROR'      - An error message. A Callstack is recommended.
         * 
         * @access  protected
         * @since   0.1
         */
        protected string $message_level = 'DEBUG';

        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected string $HTML_message;
        
        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected string $message_serialized;
        
        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected bool $is_up_to_date_with_db = false;
        
        /**
         * 
         * 
         * @access  protected
         * @since   0.1
         */
        protected bool $fully_constructed = false;
        
        /**
         * 
         * 
         * @since   0.1
         * @param   string  $text
         * @param   string  $callstack
         * @param   string  $serialized_message
         * @return  void
         */
        public function __construct( string $text, string $callstack = '', string $serialized_message = '' ) {
            if ( ! isset($text) && $text == '' ) unset($this);
            if ( isset($callstack) && $callstack != '' ) $this->callstack = $callstack;
            $this->content = $text;
        }

        /**
         * When Message Object is out of scope...
         * If message is fully constructed, check if message has been stored in database as a safety meassure.
         * 
         * @since   0.1
         * @return  void
         */
        public function __destruct() {
            
            if ( $this->check_if_fully_constructed() ) {
                if ( ! $this->does_object_exist_in_db() ) {
                    $this->update_object_and_query_database();
                }
            }

        }

        /**
         * Creates a message from a serialized message string.
         * 
         * @since   0.1
         * @param   string  $serialized_message
         * @return  Message
         */
        public static function Unserialize( string $serialized_message ) {
            throw new Exception('Feature not implimented.');
            return new Message('replace me', '', 'fetch me');
        }

        /**
         * 
         * 
         * @since   0.1
         * @return  int ID In the database.
         */
        public function save() {

            if ( $this->check_if_fully_constructed() ) {
                return $this->update_object_and_query_database();
            }
            
        }

        /**
         * 
         * 
         * @since   0.1
         * @return  int ID In the database.
         */
        protected function update_object_and_query_database() {
            throw new Exception('Feature not implimented.');

            $this->message_id = 0;
            return $this->message_id;
        }

        /**
         * 
         * 
         * @since   0.1
         * @return  bool    False if it doesn't exist or isn't up-to-date.
         */
        protected function does_object_exist_in_db() {
            // Query database
            throw new Exception('Feature not implimented.');
            return $this->is_up_to_date_with_db;
        }

        /**
         * Get the message's database ID.
         * 
         * @since   0.1
         * @return  int 
         */
        public function get_id() {
            throw new Exception('Feature not implimented.');
            return $this->message_id;
        }

        /**
         * Checks the four parameters required to be set for the message to 
         * be ready for the database.
         * 
         * $message_id, $content, $HTML_message and $message_serialized
         * 
         * @since   0.1
         * @return  bool
         */
        protected function check_if_fully_constructed() {

            // 'Message is not stored in the database.'
            if ( ! isset($this->message_id) || ! $this->message_id ) {
                $this->fully_constructed = false;
                return false;
            }
            // 'Message somehow has no text stored.'
            if ( ! isset($this->content) || ! $this->content ) {
                $this->fully_constructed = false;
                return false;
            }
            // 'Message has not yet been turned into it's HTML-Equivalent.'
            if ( ! isset($this->HTML_message) || ! $this->HTML_message ) {
                $this->fully_constructed = false;
                return false;
            }
            // 'A serialized version of the message does not exist.'
            if ( ! isset($this->message_serialized) || ! $this->message_serialized ) {
                $this->fully_constructed = false;
                return false;
            }
            
            // No issues.
            $this->fully_constructed = true;
            return true;
            
        }

        /**
         * Get or set the text of the message.
         * 
         * @since   0.1
         * @param   string  $setText  Set the text if you set this parameter.
         * @return  string
         */
        public function text( $setText = '' ) {
            if ( ! isset($setText) || ! $setText ) return $this->content;

            $old_content = $this->content;
            $this->content = $setText;
            if ( $this->content != $old_content ) $this->is_up_to_date_with_db = false;
        }

        /**
         * Sets the message callstack.
         * 
         * @since   0.1
         * @param   string  $callstack
         * @return  void
         */
        public function set_callstack( string $callstack ) {
            if ( ! isset($callstack) || ! $callstack ) return;

            $old_callstack = $this->callstack;
            $this->callstack = $callstack;
            if ( $this->callstack != $old_callstack ) $this->is_up_to_date_with_db = false;

        }

        /**
         * Gets the message callstack.
         * 
         * @since   0.1
         * @return  string
         */
        public function get_callstack() {
            return $this->callstack;
        }
    
        /**
         * Sets the message level of the message.
         * 
         * Levels:
         * 
         * 'NOTICE'     - A normal message, nothing added or needed.
         * 
         * 'DEBUG'      - A debug message. A Callstack is recommended. DEFAULT.
         * 
         * 'WARNING'    - A warning message.
         * 
         * 'ERROR'      - An error message. A Callstack is recommended.
         * 
         * @since   0.1
         * @param   string  $message_level  See valid message levels above.
         * @return  void
         */
        public function set_level( string $message_level ) {
            if ( ! isset($message_level) || ! $message_level ) return;

            $availableLevels = array( 'NOTICE', 'DEBUG', 'WARNING', 'ERROR' );
            $index = array_search( strtoupper($message_level) , $availableLevels );

            // Default message_level to 'DEBUG' if a valid match was not given.
            if ( $index === false ) { $this->message_level = 'DEBUG'; }

            $old_message_level = $this->message_level;
            $this->message_level = ( is_int($index) ) ? $availableLevels[$index] : $index;
            if ( $this->message_level != $old_message_level ) $this->is_up_to_date_with_db = false;

        }

        /**
         * Gets the message level of the message.
         * 
         * @since   0.1
         * @return  string
         */
        public function get_level() {
            return $this->message_level;
        }
    
        /**
         * Convert the message and it's parameters to it's HTML-Equivalent. This is necessary to display it to the webpage.
         * 
         * @since   0.1
         * @return  string  The message's HTML-Equivalent
         */
        public function HTMLify_message() {
            $borderCSS = '';
            $messagePrefix = '';
            switch( $this->message_level ) {
                case 'NOTICE':
                    $borderCSS = 'border-l-4 border-gray-400';
                    break;
                case 'DEBUG':
                    $borderCSS = 'border-l-4 border-blue-400';
                    break;
                case 'WARNING':
                    $borderCSS = 'border-l-4 border-orange-400';
                    $messagePrefix = 'Warning: ';
                    break;
                case 'ERROR':
                    $borderCSS = 'border-l-8 border-red-600';
                    $messagePrefix = '<strong class="text-red-800">Error:</strong> ';
                    break;
            }

            $old_HTML_message = $this->HTML_message;
            $this->HTML_message = sprintf('<div %s class="message %s shadow-inner min-h-[24px] h-8 w-full"><span><p>%s %s</p></span></div>', 
                ( isset($this->message_id) && $this->message_id ) ? 'id="'.$this->message_id.'"' : '', 
                $borderCSS, $messagePrefix, $this->content
            );

            if ( $this->HTML_message != $old_HTML_message ) $this->is_up_to_date_with_db = false;
            return $this->HTML_message;
            
        }

        /**
         * Serialize the message. This is necessary to upload it to the database.
         * 
         * @since   0.1
         * @return  string  The serialized message.
         */
        public function serialize_message() {
            
            throw new Exception('Feature not implimented.');
            
            $old_serialized_message = $this->message_serialized;
            if ( $this->message_serialized != $old_serialized_message ) $this->is_up_to_date_with_db = false;
            return $this->message_serialized;
            
        }

    }

}