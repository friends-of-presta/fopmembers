{extends file='customer/page.tpl'}

{block name='page_title'}
  {l s='FoP Members' mod='fopmembers'}
{/block}

{block name='page_content'}
    {if $customers}
        <ul>
            {foreach $customers as $customer}
                <li>
                    <h2>{$customer.company}</h2>
                    <p>
                    <strong>{$customer.lastname} {$customer.firstname}</strong>
                    <br />{$customer.postcode} {$customer.city} - {$customer.country}<br />
                    {if $customer.website}
                        <a href="{$customer.website}">{$customer.website}</a>
                    {/if}
                    </p>
                </li>
            {/foreach}
        </ul>
    {else}
        <p>{l s='If you'd like to be the first to appear in our directory, all you have to do is join our association. Don't delay!' mod='fopmembers'}</p>
    {/if}
{/block}