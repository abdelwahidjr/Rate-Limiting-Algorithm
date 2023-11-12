// For a real-world application, You'll need to expand this to handle the time aspect correctly and ensure thread safety.
// Possibly using a database or in-memory store like Redis to maintain state across multiple requests and servers.
// Since this implementation is supposed to be a simple, unit-testable algorithm, So it does not cover persistence or thread safety.

function rateLimiter($currentState, $creditsPerUnit, $creditsToConsume) {
    static $freeInvocationCounter = 0;
    $freeInvocationCounter++;
    
    // Check if this is a free invocation
    $isFree = $freeInvocationCounter % 3 === 0;

    if (!$isFree) {
        if ($currentState->consumedCredits + $creditsToConsume > $creditsPerUnit) {
            // Not enough credits
            return ['allowed' => false, 'state' => $currentState];
        }
        // Consume credits
        $currentState->consumedCredits += $creditsToConsume;
    }

    // Enough credits or a free invocation
    return ['allowed' => true, 'state' => $currentState];
}

// Example of a state object
class CreditState {
    public $consumedCredits;

    public function __construct($consumedCredits = 0) {
        $this->consumedCredits = $consumedCredits;
    }
}

// Unit tests or examples
$state = new CreditState();
print_r(rateLimiter($state, 10, 2)); // should succeed
print_r(rateLimiter($state, 10, 2)); // should succeed
print_r(rateLimiter($state, 10, 2)); // should be free and succeed
print_r(rateLimiter($state, 10, 9)); // should fail
