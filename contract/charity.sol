// SPDX-License-Identifier: MIT

pragma solidity ^0.8.3;

contract Charity {
    address public owner;

    event Withdraw(
        uint value
    );

    constructor() {
        owner = msg.sender;
    }
    receive() external payable {}

    function donate() public payable {}

    function withdraw() public {
        uint amount = address(this).balance;

        (bool sent, ) = owner.call{value: amount}("");
        require(sent, "Failed to send Ether");
        emit Withdraw(amount);
    }

    function destroySmartContract() public {
        require(msg.sender == owner, "You are not the owner");
        selfdestruct(payable(owner));
    }
}

