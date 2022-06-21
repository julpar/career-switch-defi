<?php
namespace app\tests\mocks;

use app\infrastructure\api\RooftopBlocksAPIClientInterface;

class RooftopBlocksAPIClientMock implements RooftopBlocksAPIClientInterface
{
    public function getBlocks(): array
    {
        return [
         "FD5W7WevtJK1mH2IvbTYnJTyHzGvK7YZW0QbVEDoDp5r6HhyZPJsfPQ8bFnZIz4w8aJ4AozMuDadhwneoXFh6TBWXKMyIiMItzZH",
         "mSilnBPE0zPd9j2bB1umKffRdTjcklsKA4S78LG6F8S0gLbawBDPTsEfMZ1NniqyyNNnNn1srKMjiW9kted7tUJoVHhPAGOQZEHV",
         "HSc8gjBDkhI8IC4LTtLohbgA5Vx934h15HVFtiPAMnGeQUBrDUi2fOAHIfrJ6GZmI0wKQfht5fjDLsrUJI58G0wRvz5nyV7Og6Up",
         "GjcZlavRR7RPKtlE34WntwCRGVjPA7bbKE2OFYT0eMUszzgeINrLI7v7vt7hHSmU4w15Lko6nPmuy2UqBDRLq661JGx5EtT2Vv7Q",
         "PJZg5RrohnMsuHeZYN2FsmvD5KPrf0s67ivGBOoch8eL4rM8HLIvwCSIF23HTBq8NCIIXVnfy310eYEgQsnC1EvOVtPuhWIwI4z2",
         "w8ahYxvHqljvRWd9TQRuzrIzWFh8S2oz19Bs9rwAagClpbaSeG7kixSOJUFRehAloWLiljpsROLWZnNPw4lCioaBZNspBv3vMRQH",
         "iIoKN1JxnaLvhNRgoHMDhDbT7ZYo7QrJHNcwY2scprJLtmzEqchYD6m61QQ465UYnvGlv81wCls8bKFYGxNYNKLBGG2353BTKdWK",
         "FLcJ9eb2mdjEfF5TwT7aPOB46zRBvhO0ZKVaettlIHImrjuBWRTZGIIHPWiVPA6cisGCvelIY27DeFTr1XwaXeuetwa2n95oleew",
         "TXzz15MHoa2aiNWjRjZoL8x98j3T6THMRUGq6iX9AhzxFbkQzCvN03ucA5rl9codp673u9QbVRv6AfonACyDwMyJEz5DG6FA9Rms"
     ];
    }

    public function isNext(string $base, string $nextCandidate): bool
    {
        return true;
    }

    public function check(array $blocks): bool
    {
        return true;
    }
}
