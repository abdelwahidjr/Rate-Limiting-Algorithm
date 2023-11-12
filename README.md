## Rate-Limiting-Algorithm
Rate Limiting Algorithm

- Based on the scenario and requirements you've provided, the goal is to create a rate-limiting algorithm in PHP that will manage API usage and prevent users from exceeding their allotted credit limits per time unit.
- This algorithm should function without side effects, meaning it won't directly handle any state persistence such as database reads or writes.

## High-Level overview of how you can implement the rate-limiting algorithm in PHP :

- Define the Rate Limiter Function: Create a function that accepts the current credit consumption state, the credit limit per time unit, and the number of credits to consume.

- Determine the Time Window: Calculate the current time window based on the allowed credits per time unit. For instance, if it's 10 credits per 5 minutes, determine the start of the current 5-minute window.

- Check Credit Availability: Compare the current state's consumed credits with the allowed credits. If the number of consumed credits is less than the allowed number, the function will return that there are enough credits.

- Update State: If there are enough credits, update the state by incrementing the consumed credits by the number of credits to consume, unless it's a free invocation as per the loophole.

- Handle Free Invocations: Implement a counter to track invocations. Every third call should not consume credits.

- Return Values: The function should return an indication of whether the operation was allowed (i.e., there were sufficient credits) and the updated state object.

- Unit Testing: Write examples or unit tests demonstrating the algorithm working with various inputs and scenarios.

## Testing :

- For a real-world application, You'll need to expand this to handle the time aspect correctly and ensure thread safety.
- Possibly using a database or in-memory store like Redis to maintain state across multiple requests and servers.
- Since this implementation is supposed to be a simple, unit-testable algorithm, So it does not cover persistence or thread safety.

